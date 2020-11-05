<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\Transaction;
use Carbon\Carbon;
use Auth;

class TransactionRepository extends Model
{
    public function __construct( Transaction $transaction) {
        $this->model = $transaction;
    }

    public function getWeeklyExpenses()
    {
        return $this->model->toUser()->where('type', 0)->where('exclude', 0)->whereDate('date', '>=', Carbon::now()->startOfWeek()->format('Y-m-d'))->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('d'); // grouping by day
        });
    }

    public function getMonthlyExpenses() {
        return $this->model->toUser()->where('type', 0)->where('exclude', 0)->whereDate('date', '>=', Carbon::now()->firstOfMonth()->format('Y-m-d'))->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('d'); // grouping by month
        });
    }

    public function getAnnualExpenses() {
        return $this->model->toUser()->where('type', 0)->where('exclude', 0)->whereDate('date', '>=', Carbon::now()->firstOfYear()->format('Y-m-d'))->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('m-d'); // grouping by month-day
        });
    }

    public function getMonthlyTotalSpending() {
        return $this->model->toUser()->where('type', 0)->where('exclude', 0)->whereDate('date', '>=', Carbon::now()->firstOfMonth()->format('Y-m-d'))->orderBy('date', 'ASC')->get()->sum('amount');
    }

    public function getMonthlyTotalIncome() {
        return $this->model->toUser()->where('type', 1)->where('exclude', 0)->whereDate('date', '>=', Carbon::now()->firstOfMonth()->format('Y-m-d'))->orderBy('date', 'ASC')->get()->sum('amount');
    }

    public function syncTransactions( $account ) {

    }

    public function applyRule( $rule )
    {
        $transactions = $this->model->where('user_id', Auth::User()->id)->where('vendor', $rule->vendor)->where('category', '!=', $rule->category)->get();

        foreach( $transactions as $transaction ) {
            $transaction->category = $rule->category;
            $transaction->save();
        }

        return count($transactions);
    }
}
