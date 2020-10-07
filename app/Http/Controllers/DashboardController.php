<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Budgets\BudgetRepository;
use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionRepository;
use App\Models\MX\MXRepository;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( MXRepository $mXRepository, BudgetRepository $budgetRepository )
    {
        $this->middleware('auth');
        $this->middleware('notifications');
        $this->mx = $mXRepository;
        $this->budgets = $budgetRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( TransactionRepository $transactionRepository)
    {
        if (Auth::User()->income == null) {
            return redirect('/onboarding');
        }
        if (!Auth::User()->mx_user_guid) {
            $user = Auth::User();
            $user->mx_user_guid = $this->mx->generateUserGuid( $user );
            $user->save();
        }
        $transactions = Transaction::where('user_id', Auth::User()->id)->where('exclude', 0)->with('account')->orderBy('date', 'DESC')->get();
        $accounts = Account::where('user_id', Auth::User()->id)->limit(3)->with('transactions')->get();
        $budgets = $this->budgets->getMappedBudgets();

        $weeklyExpenses = $transactionRepository->getWeeklyExpenses();
        $monthlyExpenses = $transactionRepository->getMonthlyExpenses();
        $annualExpenses = $transactionRepository->getAnnualExpenses();

        return view('user.dashboard', compact('transactions', 'accounts', 'weeklyExpenses', 'budgets', 'monthlyExpenses', 'annualExpenses'));
    }
}
