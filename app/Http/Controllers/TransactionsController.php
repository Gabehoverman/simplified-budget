<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionCategory;
use App\Models\Account;
use Auth;

class TransactionsController extends Controller
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
     * Show the transactions page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::User()->id)->with('account')->get();
        $accounts = Account::where('user_id', Auth::User()->id)->get();

        return view('user.transactions', array('transactions'=>$transactions, 'accounts' => $accounts));
    }


    /**
     * Shows a Transaction
     *
     * @param [Integer] $id
     * @return Transaction
     */
    public function show( $id )
    {
        $transaction = Transaction::find($id);

        return response(json_encode($transaction), 200);
    }

    /**
     * Creates a new Transaction
     *
     * @return Transaction
     */
    public function store( Request $request )
    {
        $transaction = new Transaction($request->input());
        $transaction->user_id = \Auth::User()->id;

        if ($transaction->type == 1) {
            $transaction->category = TransactionCategory::INCOME;
        }
        if ($transaction->type == 2) {
            $transaction->category = TransactionCategory::TRANSFER;
        }
        if ($transaction->type == 3) {
            $transaction->category = TransactionCategory::FEES_CHARGES;
        }

        $transaction->save();
        $transaction->account;

        return response(json_encode($transaction), 200);
    }

    /**
     * Updates a Transaction
     *
     * @return Transaction
     */
    public function update( $id, Request $request )
    {
        $transaction = Transaction::find($id);
        $transaction->update( $request->input() );
        $transaction->account;

        return response(json_encode($transaction), 200);
    }

    /**
     * Deletes a Transaction
     *
     * @return Transaction
     */
    public function destroy( $id )
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        return response(200);
    }
}
