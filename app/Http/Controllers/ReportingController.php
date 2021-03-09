<?php

namespace App\Http\Controllers;

use App\Models\Budgets\BudgetRepository;
use Illuminate\Http\Request;
use App\Models\Transactions\Transaction;
use Carbon\Carbon;

class ReportingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( BudgetRepository $budgetRepository )
    {
        $this->middleware('auth');
        $this->middleware('notifications');
        $this->middleware('billing-verification');
        $this->budgets = $budgetRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $month = request()->input('month') ? \Carbon\Carbon::createFromFormat('F, Y', request()->input('month') ) : \Carbon\Carbon::now();
        $start = Carbon::parse($month)->firstOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $categories = Transaction::toUser()->whereIn('type', [0,3])->where('exclude', 0)->where('date', '>=', $start)->get()->groupBy('category');
        $budgets = $this->budgets->getMappedBudgets();
        // $vendors = Transaction::toUser()->whereIn('type', [0,3])->where('date', '>=', $start)->orderBy('amount')->get()->groupBy('vendor');
        $vendors = Transaction::groupBy('category')->toUser()->whereIn('type', [0,3])->where('exclude', 0)->where('date', '>=', $start)->selectRaw('category, sum(amount) as sum')->orderBy('sum', 'desc')->get()->take(3);
        $income = Transaction::toUser()->where('type', 1)->where('exclude', 0)->where('date', '>=', $start)->sum('amount');
        $expenses = Transaction::toUser()->whereIn('type', [0,3])->where('exclude', 0)->where('date', '>=', $start)->sum('amount');
        $monthlyTransactions = Transaction::toUser()->whereIn('type', [0,3])->where('exclude', 0)->where('date', '>=', $start)->where('date', '<=', $end)->orderBy('date', 'ASC')->get()->groupBy('date');
        $previousMonthlyTransactions = Transaction::toUser()->where('exclude', 0)->where('date', '>=', \Carbon\Carbon::parse($month)->subMonth(1)->firstOfMonth())
                                                                ->where('date', '<=',  \Carbon\Carbon::parse($month)->subMonth(1)->endOfMonth())
                                                                ->orderBy('date', 'ASC')
                                                                ->get()->groupBy('date');


        return view('user.reporting', compact('categories', 'budgets', 'vendors', 'income', 'expenses', 'monthlyTransactions', 'previousMonthlyTransactions', 'month'));
    }
}
