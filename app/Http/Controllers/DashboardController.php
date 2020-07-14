<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Auth;

class DashboardController extends Controller
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
        $transactions = Transaction::where('user_id', Auth::User()->id)->with('account')->get();
        $accounts = Account::where('user_id', Auth::User()->id)->limit(3)->with('transactions')->get();


        return view('user.dashboard', array('transactions'=> $transactions, 'accounts'=>$accounts));
    }
}
