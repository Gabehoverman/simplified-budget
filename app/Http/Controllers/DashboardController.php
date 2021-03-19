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
        $this->middleware('billing-verification');
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
        if (Auth::User()->income == null || Auth::User()->plan == null) {
            return redirect('/onboarding');
        }

        if (!Auth::User()->mx_user_guid) {
            $user = Auth::User();
            $user->mx_user_guid = $this->mx->generateUserGuid( $user );
            $user->save();
        }

        if (!Auth::User()->stripe_id) {
            $stripeCustomer = Auth::User()->createAsStripeCustomer();
        }

        if (!Auth::User()->custom_dashboard) {
            \Auth::User()->custom_dashboard = [[
                "name" => "Spending Overview",
                "key" => "spending_overview",
                "show" => true
            ], [
                "name" => "Account Overview",
                "key" => "account_overview",
                "show" => true
            ], [
                "name" => "Budget Overview",
                "key" => "budget_overview",
                "show" => true
            ], [
                "name" => "Cashflow Overview",
                'key' => "cashflow_overview",
                "show" => true
            ]];
        }

        $start = Carbon::now()->firstOfMonth();
        $end = Carbon::now()->endOfMonth();
        $month = Carbon::now();

        $transactions = Transaction::where('user_id', Auth::User()->id)->where('exclude', 0)->with('account')->orderBy('date', 'DESC')->get();
        $accounts = Account::where('user_id', Auth::User()->id)->limit(3)->with('transactions')->get();
        $budgets = $this->budgets->getMappedBudgets();
        $vendors = Transaction::groupBy('category')->toUser()->whereIn('type', [0,3])->where('exclude', 0)->where('date', '>=', $start)->selectRaw('category, sum(amount) as sum')->orderBy('sum', 'desc')->get()->take(3);
        $income = Transaction::toUser()->where('type', 1)->where('exclude', 0)->where('date', '>=', $start)->sum('amount');
        $expenses = Transaction::toUser()->whereIn('type', [0,3])->where('exclude', 0)->where('date', '>=', $start)->sum('amount');

        $weeklyExpenses = $transactionRepository->getWeeklyExpenses();
        $monthlyExpenses = $transactionRepository->getMonthlyExpenses();
        $annualExpenses = $transactionRepository->getAnnualExpenses();

        $categories = Transaction::toUser()->whereIn('type', [0,3])->where('exclude', 0)->where('date', '>=', $start)->get()->groupBy('category');
        $previousMonthlyTransactions = Transaction::toUser()->where('exclude', 0)->where('date', '>=', \Carbon\Carbon::parse($month)->subMonth(1)->firstOfMonth())
                ->where('date', '<=',  \Carbon\Carbon::parse($month)->subMonth(1)->endOfMonth())
                ->orderBy('date', 'ASC')
                ->get()->groupBy('date');

        return view('user.dashboard', compact('transactions', 'accounts', 'weeklyExpenses', 'budgets', 'monthlyExpenses', 'annualExpenses', 'vendors', 'income', 'expenses', 'categories', 'previousMonthlyTransactions'));
    }

    public function updateCustomDashboard(Request $request)
    {
        $user = \App\User::find( $request->input('id') );
        $user->custom_dashboard = $request->input('custom_dashboard');
        $user->save();

        return response( json_encode( $user ), 200 );
    }
}
