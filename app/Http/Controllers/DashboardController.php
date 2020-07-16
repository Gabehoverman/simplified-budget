<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;
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
        $weeklyExpenses = Transaction::where('type', 0)->where('date', '>=', Carbon::now()->startOfWeek())->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('d'); // grouping by months
        });
        $monthlyExpenses = Transaction::where('type', 0)->where('date', '>=', Carbon::now()->firstOfMonth())->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('d'); // grouping by months
        });
        $annualExpenses = Transaction::where('type', 0)->where('date', '>=', Carbon::now()->firstOfYear())->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('m-d'); // grouping by months
        });
        return view('user.dashboard', compact('transactions', 'accounts', 'weeklyExpenses', 'monthlyExpenses', 'annualExpenses'));
    }
}
