<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgets\Budget;
use App\Models\Budgets\BudgetRepository;
use App\Models\Transactions\TransactionRepository;
use App\Models\Account;
use Auth;

class BudgetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( BudgetRepository $budgetRepository, TransactionRepository $transactionRepository )
    {
        $this->middleware('auth');
        $this->middleware('notifications');
        $this->budgets = $budgetRepository;
        $this->transactions = $transactionRepository;
    }

    /**
     * Show the transactions page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $budgets = $this->budgets->getMappedBudgets();
        $accounts = Account::where('user_id', Auth::User()->id)->get();
        $totals = array(
            'income' => $this->transactions->getMonthlyTotalIncome(),
            'spending' => $this->transactions->getMonthlyTotalSpending(),
            'estimated_income' => Auth::User()->pay
        );

        return view('user.budgets', array('budgets'=>$budgets, 'accounts' => $accounts, 'totals' => $totals));
    }

    /**
     * Shows a Budget
     *
     * @param [Integer] $id
     * @return Budget
     */
    public function show( $id )
    {
        $budget = Budget::find($id);

        return response(json_encode($budget), 200);
    }

    /**
     * Creates a new Budget
     *
     * @return Budget
     */
    public function store( Request $request )
    {
        $budget = new Budget($request->input());
        $budget->user_id = Auth::User()->id;
        $budget->save();

        $budget->total = $budget->monthlyTotal();
        $budget->previousMonthlyTotal = $budget->previousMonthlyTotal();

        return response(json_encode($budget), 200);
    }

    /**
     * Updates a Budget
     *
     * @return Budget
     */
    public function update( $id, Request $request )
    {
        $budget = Budget::find($id);
        $budget->update( $request->input() );
        $budget->transactions;

        $budget->total = $budget->monthlyTotal();
        $budget->previousMonthlyTotal = $budget->previousMonthlyTotal();

        $this->budgets->generateNotifications([$budget]);

        return response(json_encode($budget), 200);
    }

    /**
     * Deletes a Budget
     *
     * @return Budget
     */
    public function destroy( $id )
    {
        $budget = Budget::find($id);
        $budget->delete();

        return response(200);
    }
}
