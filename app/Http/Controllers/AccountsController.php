<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Auth;

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
        $accounts = Account::where('user_id', Auth::User()->id)->with('transactions')->get();

        return view('user.accounts', array('accounts' => $accounts));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new()
    {
        return view('user.new-account');
    }

      /**
     * Creates a new Transaction
     *
     * @return Account
     */
    public function store( Request $request )
    {
        $account = new Account( $request->input() );
        $account->user_id = \Auth::User()->id;
        $account->save();

        return response(json_encode($account), 200);
    }

    /**
     * Updates a Transaction
     *
     * @return Account
     */
    public function update( $id, Request $request )
    {
        $account = Account::find($id);
        $account->update( $request->input() );

        return response(json_encode($account), 200);
    }

    /**
     * Deletes a Transaction
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
