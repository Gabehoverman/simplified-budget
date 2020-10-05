<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transactions\Transaction;
use App\Models\Institutions\InstitutionRepository;
use App\Models\MX\MXRepository;
use App\Models\Budgets\Budget;
use App\User;

class OnboardingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( InstitutionRepository $institutionRepository )
    {
        $institutions = $institutionRepository->getInstitutions();
        $account = \Auth::User()->accounts()->first();
        $budgets = Budget::where('user_id', \Auth::User()->id)->get();
        if (!$account) {
            $account = new Account();
        }

        return view('user.onboarding', compact('institutions', 'account', 'budgets'));
    }

    public function update( Request $request )
    {
        $user = \Auth::User()->update( $request->input('user') );

        $accData = $request->input('account');
        if ( isset( $accData['id'] ) ) {
            $account = Account::find( $accData['id']);
            $account->update($accData);
            $account->save();
        } else {
            $account = new Account();
        }
        $budgetData = $request->input('budgets');
        if ($budgetData) {
            foreach ($budgetData as $data) {
                $budget = new Budget($data);
                $budget->name = $data['category'];
                $budget->user_id = \Auth::User()->id;
                $budget->account_id = $account->id;
                $budget->save();
            }
        }

        return response( json_encode( array('user' => $user, 'account' => $account ) ), 200 );
    }

    public function transactions ( $account_id, MXRepository $mXRepository )
    {
        $account = Account::find( $account_id );
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
