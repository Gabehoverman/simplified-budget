<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneySavers\MoneySaverRepository;
use App\Models\Account;
use App\Models\MoneySavers\MoneySaver;
use App\Models\Budgets\BudgetRepository;
use App\Models\Transactions\TransactionRepository;
use Auth;

class WhatIfController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( MoneySaverRepository $moneySaverRepository, BudgetRepository $budgetRepository, TransactionRepository $transactionRepository )
    {
        $this->middleware('auth');
        $this->middleware('notifications');
        $this->middleware('billing-verification');
        $this->moneySavers = $moneySaverRepository;
        $this->budgets = $budgetRepository;
        $this->transactions = $transactionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $moneySavers = $this->moneySavers->getRecommendedMoneySavers();
        $accounts = Account::where('user_id', Auth::User()->id)->get();

        $month = request()->input('month') ? \Carbon\Carbon::createFromFormat('F, Y', request()->input('month') ) : \Carbon\Carbon::now();

        $budgets = $this->budgets->getMappedBudgets( $month );

        $totals = array(
            'income' => $this->transactions->getMonthlyTotalIncome( $month ),
            'spending' => $this->transactions->getMonthlyTotalSpending( $month ),
            'estimated_income' => \Auth::User()->pay
        );

        return view('user.what-if', compact('moneySavers', 'accounts', 'totals', 'budgets'));
    }

    public function store( Request $request )
    {
        //todo: calculate stuff here
        $responseData = [];
        $inputData = $request->input();
        $user = Auth::User();

        switch ( $inputData['type'] ) {
            case 'income':
                // $operator = ($inputData['income_type'] == 'increase' ? ' + ' : ' - ');
                $diff = $inputData['income_new_amount'] - $inputData['income_amount'];

                $responseData['current_monthly_income'] = $inputData['income_amount'] / 12;
                $responseData['new_monthly_income'] = $inputData['income_new_amount'] / 12;
                $responseData['monthly_income_difference'] = $diff / 12;

                $responseData['current_annual_income'] = $inputData['income_amount'];
                $responseData['new_annual_income'] = $inputData['income_new_amount'];
                $responseData['annual_income_difference'] = $diff;

                $responseData['new_monthly_budget'] = (float) $this->budgets->getMonthlyBudgetSum( $user ) + (float) $diff / 12;
                $responseData['new_annual_budget'] = ((float) $this->budgets->getAnnualBudgetSum($user) + (float) $diff );

                $responseData['monthly_income'] = eval('return (' . $user->income . '+' . $diff . ') / 12;');
                $responseData['annual_income'] = eval('return ' . $user->income . '+' . $diff . ';');
                $responseData['monthly_budget'] = (float) $this->budgets->getMonthlyBudgetSum( $user ) + (float) $diff / 12;
                $responseData['annual_budget'] = ((float) $this->budgets->getAnnualBudgetSum($user) + (float) $diff );
                break;
            case 'spending':
                //todo: Get average monthly spending amount
                //todo: Project increase / decrease onto that spending amount
                //todo: Get budget amount, and project that spending amount onto budgets
                $operator = ($inputData['spending_type'] == 'increase' ? ' + ' : ' - ');
                $inputData['monthly_spending_amount'] = $inputData['spending_timeframe'] == 'monthly' ? $inputData['spending_amount']  : $inputData['spending_amount'] / 12;
                $inputData['annual_spending_amount'] = $inputData['spending_timeframe'] == 'monthly' ? $inputData['spending_amount'] * 12  : $inputData['spending_amount'];
                $responseData['monthly_spending'] = eval('return (' . ( $user->income / 12). $operator . $inputData['monthly_spending_amount'] . ');');
                $responseData['annual_spending'] = eval('return ' . $user->income . $operator . $inputData['annual_spending_amount'] . ';');
                $responseData['monthly_spending_budget'] = (float) $this->budgets->getMonthlyBudgetSum( $user ) + (float) $inputData['spending_amount'] / ( $inputData['spending_timeframe'] == 'monthly' ? 1 :12);
                $responseData['annual_spending_budget'] = ((float) $this->budgets->getAnnualBudgetSum($user) + (float) $inputData['spending_amount'] ) * ( $inputData['spending_timeframe'] == 'monthly' ? 12 :1);
                break;
            case 'debt':
                //todo: Calculate the potential change to savings rate & monthly budgetable amount if a new debt is added

                $p = $inputData['debt_payment']; //perioic payment
                $pv = $inputData['debt_amount'];// balance
                $R =  ( $inputData['debt_apr'] / 100) / 12; // Interest rate;
                $calcOne = log( $p / ( $p - ( $pv * $R ) ) );
                $calcTwo = log ( 1 + $R );
                $timeframeOne =  $calcOne / $calcTwo;

                $responseData['timeframe_one'] = ceil($timeframeOne);
                $responseData['interest_one'] = $timeframeOne * $inputData['debt_payment'] - $inputData['debt_amount'];
                $responseData['total_cost'] = $timeframeOne * $inputData['debt_payment'];
                $responseData['monthly_payment'] = $inputData['debt_payment'];


                $operator = ' + ';
                $responseData['monthly_debt'] = eval('return (' . $user->income . $operator . $inputData['debt_amount'] . ') / 12;');
                $responseData['annual_debt'] = eval('return ' . $user->income . $operator . $inputData['debt_amount'] . ';');
                $responseData['monthly_debt_budget'] = (float) $this->budgets->getMonthlyBudgetSum( $user ) + (float) $inputData['debt_payment'];
                $responseData['annual_debt_budget'] = ((float) $this->budgets->getAnnualBudgetSum($user) + (float) $inputData['debt_payment'] * 12 );
                break;
            case 'account':

                // Current Calculation
                $p = $inputData['account_current_payment']; //perioic payment
                $pv = $inputData['account_amount'];// balance
                $R =  ( $inputData['account_apr'] * .01 ) / 12; // Interest rate;

                $stepOne = $pv * $R;
                $stepTwo = $p - $stepOne;
                $stepThree = $p / $stepTwo;
                $stepFour = log( abs($stepThree) );

                $calcOne = log( ( $p / abs( $p - ( $pv * $R ) ) ) );
                $calcTwo = log ( 1 + $R );
                $timeframeOne =  $calcOne / $calcTwo;

                // New Calculation
                if ( isset($inputData['account_one_time']) && $inputData['account_one_time'] == 1) {
                    // If one time payment, subtract payment amount from balance & calculate using current numbers
                    $pv = $pv - $inputData['account_new_payment'];
                    $calcOne = log( $p / ( $p - ( $pv * $R ) ) );
                    $timeframeTwo = $calcOne / $calcTwo;
                    $responseData['interest_two'] = $timeframeTwo * $inputData['account_current_payment'] - $pv;
                } else {
                    $calcOne = log( $inputData['account_new_payment'] / ( $inputData['account_new_payment'] - ( $pv * $R ) ) );
                    $timeframeTwo = $calcOne / $calcTwo;
                    $responseData['interest_two'] = $timeframeTwo * $inputData['account_new_payment'] - $inputData['account_amount'];
                }

                $responseData['timeframe_one'] = ceil($timeframeOne);
                $responseData['timeframe_two'] = ceil($timeframeTwo);

                $responseData['timeframe_difference'] = ceil( $timeframeOne ) - ceil( $timeframeTwo );
                $responseData['payment_difference'] = $inputData['account_new_payment'] - $inputData['account_current_payment'];

                $responseData['interest_one'] = $timeframeOne * $inputData['account_current_payment'] - $inputData['account_amount'];

                $responseData['interest_difference'] = number_format( abs( $responseData['interest_one'] - $responseData['interest_two'] ), 2);
                $responseData['account_one_time'] = @$inputData['account_one_time'];
                $responseData['account_new_payment'] = $inputData['account_new_payment'];
                break;
            case 'money-saver':
                $moneySaver = MoneySaver::find( $inputData['money_saver_id'] );
                $account = Account::find( $inputData['account_id'] );
                $details = '';

                foreach( $moneySaver->features as $index => $feature ) {
                    $current = $account[ $feature['compare_to'] ];
                    $new = $feature;
                    $details .= ($index > 0 ? ' and' : '').( $current > $feature['value'] ? ' decrease' : ' increase').' your accounts '.$feature['label'].' by '. $this->formatForDisplay($feature['compare_to'], abs( $current - $feature['value'] ));
                    $responseData['features'][] = array(
                        'current' => $current,
                        'new' => $new
                    );
                }
                $responseData['money_saver']  = $moneySaver;
                $responseData['account'] = $account;
                $responseData['details'] = $details;
                break;
            default:

                break;
        }

        return response( json_encode( $responseData ), 200);
    }

    public function formatForDisplay( $type, $value ) {
        switch( $type ) {
            case 'apr':
                return $value.'%';
            case 'minimum_payment':
                return '$'.$value;
        }
    }
}
