<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportingController extends Controller
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
        $categories = Transaction::where('type', 0)->where('date', '>=', Carbon::now()->firstOfMonth())->get()->groupBy('category');
        $vendors = Transaction::where('type', 0)->where('date', '>=', Carbon::now()->firstOfMonth())->orderBy('amount')->get()->groupBy('vendor');
        $income = Transaction::where('type', 1)->where('date', '>=', Carbon::now()->firstOfMonth())->sum('amount');
        $expenses = Transaction::where('type', 0)->where('date', '>=', Carbon::now()->firstOfMonth())->sum('amount');
        $monthlyTransactions = Transaction::where('date', '>=', Carbon::now()->firstOfMonth())->orderBy('date', 'ASC')->get()->groupBy('date');
        $previousMonthlyTransactions = Transaction::where('date', '>=', new Carbon('first day of last month'))
                                                                ->where('date', '<=', new Carbon('last day of last month'))
                                                                ->orderBy('date', 'ASC')
                                                                ->get()->groupBy('date');


        return view('user.reporting', compact('categories', 'vendors', 'income', 'expenses', 'monthlyTransactions', 'previousMonthlyTransactions'));
    }
}
