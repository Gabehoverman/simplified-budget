<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\Transaction;
use Carbon\Carbon;

class TransactionRepository extends Model
{
    public function __construct( Transaction $transaction) {
        $this->model = $transaction;
    }

    public function getWeeklyExpenses()
    {
        return $this->model->toUser()->where('type', 0)->where('date', '>=', Carbon::now()->startOfWeek())->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('d'); // grouping by day
        });
    }

    public function getMonthlyExpenses() {
        return $this->model->toUser()->where('type', 0)->where('date', '>=', Carbon::now()->firstOfMonth())->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('d'); // grouping by month
        });
    }

    public function getAnnualExpenses() {
        return $this->model->toUser()->where('type', 0)->where('date', '>=', Carbon::now()->firstOfYear())->orderBy('date', 'ASC')->get()->groupBy(function($date) {
            return Carbon::parse($date->date)->format('m-d'); // grouping by month-day
        });
    }

}
