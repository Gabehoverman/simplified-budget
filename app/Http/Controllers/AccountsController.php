<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Institutions\InstitutionRepository;
use Auth;
use Carbon\Carbon;

class AccountsController extends Controller
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
    public function index()
    {
        $accounts = Account::where('user_id', Auth::User()->id)->with('transactions', 'institution')->get();

        return view('user.accounts', array('accounts' => $accounts));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new(InstitutionRepository $institutionRepository)
    {
        $institutions = $institutionRepository->getInstitutions();

        return view('user.new-account', compact( 'institutions'));
    }

    /**
     * Shows a Specific Account
     *
     */
    public function show( Request $request, $id, InstitutionRepository $institutionRepository )
    {
        $account = Account::where('id', $id)->with('institution')->first();
        $transactions = $account->transactions->groupBy(function($date) {
            return Carbon::parse($date->date)->format('m'); // grouping by month
        });
        $institutions = $institutionRepository->getInstitutions();

        return view('user.show-account', compact('account', 'transactions', 'institutions'));
    }

    /**
     * Edit an account
     *
     */
    public function edit( Request $request, $id )
    {
        $account = Account::find($id);

        return view('user.edit-account', compact('account'));
    }

      /**
     * Creates a new Account
     *
     * @return Account
     */
    public function store( Request $request )
    {
        $account = new Account( $request->input() );
        $account->institution_id = $request->input( 'institution_id' );
        $account->user_id = \Auth::User()->id;
        $account->save();

        return response(json_encode($account), 200);
    }

    /**
     * Updates an Account
     *
     * @return Account
     */
    public function update( $id, Request $request )
    {
        $account = Account::find($id);
        $account->update( $request->input() );
        $account->institution;

        return response(json_encode($account), 200);
    }

    /**
     * Deletes an Account
     *
     * @return Account
     */
    public function destroy( $id )
    {
        $account = Account::find($id);
        $account->delete();

        return response(200);
    }
}
