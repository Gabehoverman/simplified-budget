<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transactions\Transaction;
use App\Models\Institutions\InstitutionRepository;
use App\Models\MX\MXRepository;
use App\Models\Budgets\Budget;
use App\User;
use Auth;

class OnboardingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( MXRepository $mXRepository )
    {
        $this->middleware('auth');
        $this->middleware('notifications');
        $this->mx = $mXRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( InstitutionRepository $institutionRepository )
    {
        if (!Auth::User()->mx_user_guid) {
            $user = Auth::User();
            $user->mx_user_guid = $this->mx->generateUserGuid( $user );
            $user->save();
        }

        $institutions = $institutionRepository->getInstitutions();
        $account = \Auth::User()->accounts()->first();
        $budgets = Budget::where('user_id', \Auth::User()->id)->get();
        $transactions = Transaction::where('user_id', \Auth::User()->id)->get();

        if (!$account) {
            $account = new Account();
        }

        return view('user.onboarding', compact('institutions', 'account', 'budgets', 'transactions'));
    }

    public function update( Request $request )
    {
        $user = \Auth::User();
        $user->update( $request->input('user') );

        $accData = $request->input('account');
        if ( isset( $accData['id'] ) ) {
            $account = Account::find( $accData['id']);
            $account->update($accData);
            $account->save();
        } else {
            $account = new Account($accData);
            $account->user_id = Auth::User()->id;
            $account->save();
            $account->id;
        }

        $transactionData = $request->input('transactions');
        $transactions = [];
        if ($transactionData) {
            foreach ($transactionData as $data) {
                $transaction = new Transaction($data);
                $transaction->user_id = \Auth::User()->id;
                $transaction->account_id = $account->id;
                $transaction->type = 0;
                $transaction->save();
                $transactions[] = $transaction;
            }
        }

        // $budgets = [];
        // $budgetData = $request->input('budgets');
        // if ($budgetData) {
        //     foreach ($budgetData as $data) {
        //         $budget = new Budget($data);
        //         $budget->user_id = \Auth::User()->id;
        //         $budget->account_id = 0; //$account->id; Set to 0 to work with all accounts
        //         $budget->save();
        //         $budgets[] = $budget;
        //     }
        // }

        if (!\Auth::User()->stripe_id) {
            $stripeCustomer = \Auth::User()->createAsStripeCustomer();
        }

        // todo: create stripe subscription based on billing information
        # Save plan and create trial. When their trial expires, lock them to the settings / billing page until they enter their credit card information
        $plan = $request->input('plan');
        if ($plan) {
            $user->plan = $plan;
            $user->trial_ends_at = now()->addDays(10);
            $user->save();
        }

        return response( json_encode( array('user' => $user, 'account' => $account, 'transactions' => $transactions ) ), 200 );
    }

    public function transactions ( $account_id, MXRepository $mXRepository )
    {
        $account = Account::find( $account_id );

        if (!$account || $account->tracking_type == 0 ) { // No account or Manual
            return response( json_encode([]), 200 );
        }
        $transactions = $mXRepository->syncTransactions( $account );

        return response( json_encode( $transactions ), 200 );
    }

    // Legacy
    public function store( Request $request )
    {
        \Auth::User()->update($request->input('user'));

        $account = new Account($request->input('account'));
        $account->user_id = \Auth::User()->id;
        $account->save();

        // foreach ( $request->input('transactions') as $transactionData) {
        //     $transaction = new Transaction($transactionData);
        //     $transaction->account_id = $account->id;
        //     $transaction->save();
        // }

        return 200;
    }
}
