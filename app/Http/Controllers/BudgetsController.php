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
        $this->middleware('billing-verification');
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
        $month = request()->input('month') ? \Carbon\Carbon::createFromFormat('F, Y', request()->input('month') ) : \Carbon\Carbon::now();

        $budgets = $this->budgets->getMappedBudgets( $month );
        $accounts = Account::where('user_id', Auth::User()->id)->get();
        $totals = array(
            'income' => $this->transactions->getMonthlyTotalIncome( $month ),
            'spending' => $this->transactions->getMonthlyTotalSpending( $month ),
            'estimated_income' => Auth::User()->pay
        );

        return view('user.budgets', array('month' => $month, 'budgets'=>$budgets, 'accounts' => $accounts, 'totals' => $totals));
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
        $budget->monthly_amount = $budget->timeframe == 1 ? $budget->amount / 12 : $budget->amount;
        $monthly = new \stdClass();
        for ($i = 1; $i <= 12; $i++) {
            $index = \Carbon\Carbon::create()->month($i)->startOfMonth()->format('M');
            $monthly->{$index} = round( $budget->monthly_amount, 2 );
        }
        $budget->monthly_budgets = $monthly;
        $budget->annual_amount = $budget->monthly_amount * 12;
        $budget->sub_category = ( $request->input('sub_category') == 'undefined' ? null : ( $budget->sub_cateory ?: $request->input('sub_category') ) );
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
        $data = $request->input();
        if ( $budget->timeframe != $data['timeframe'] || $budget->amount != $data['amount'] ) {
            // Handle changing the default budget amounts
            $monthly = new \stdClass();
            for ($i = 1; $i <= 12; $i++) {
                $index = \Carbon\Carbon::create()->month($i)->startOfMonth()->format('M');
                $monthly->{$index} = round( ( $data['timeframe'] == 0 ? $data['amount'] : $data['amount'] / 12 ), 2 );
            }
            unset($data['monthly_budgets']);
            $budget->monthly_budgets = $monthly;
            $budget->save();
        }

        unset($data['annual_amount']);

        $budget->update( $data );
        $budget->monthly_amount = $budget->timeframe == 1 ? $budget->amount / 12 : $budget->amount;
        $budget->save();

        $annual = 0;
        for ($i = 1; $i <= 12; $i++) {
            $index = \Carbon\Carbon::create()->month($i)->startOfMonth()->format('M');
            $annual += (float) $budget->monthly_budgets[$index];
        }

        $budget->annual_amount = round($annual);
        $budget->save();

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
