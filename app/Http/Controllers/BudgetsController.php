<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgets\Budget;
use App\Models\Account;
use Auth;

class BudgetsController extends Controller
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
        $budgets = Budget::where('user_id', Auth::User()->id)->get();
        $mappedBudgets = [];
        foreach( $budgets as $budget ) {
            $budget->total = $budget->monthlyTotal();
            $budget->total = count($budget->total) > 0 ? $budget->total[0]['sum'] : 0;
            $mappedBudgets[] = $budget;
        }
        $accounts = Account::where('user_id', Auth::User()->id)->get();

        return view('user.budgets', array('budgets'=>$mappedBudgets, 'accounts' => $accounts));
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
        $budget->total = count($budget->total) > 0 ? $budget->total[0]['sum'] : 0;

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
