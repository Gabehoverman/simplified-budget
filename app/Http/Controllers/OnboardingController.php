<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transactions\Transaction;
use App\Models\Institutions\InstitutionRepository;
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

        return view('user.onboarding', compact('institutions'));
    }

    public function store( Request $request )
    {
        \Auth::User()->update($request->input('user'));

        $account = new Account($request->input('account'));
        $account->user_id = \Auth::User()->id;
        $account->save();

        foreach ( $request->input('transactions') as $transactionData) {
            $transaction = new Transaction($transactionData);
            $transaction->account_id = $account->id;
            $transaction->save();
        }

        return 200;
    }
}
