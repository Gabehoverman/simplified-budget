<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;
use App\Models\Budgets\Budget;
use Carbon\Carbon;
use Auth;

class BudgetRepository extends Model
{
    public function __construct( Budget $budget) {
        $this->model = $budget;
    }


    public function getMappedBudgets()
    {
        $budgets = $this->model->where('user_id', Auth::User()->id)->get();
        $mappedBudgets = [];
        foreach( $budgets as $budget ) {
            $budget->total = $budget->monthlyTotal();
            $budget->total = count($budget->total) > 0 ? $budget->total[0]['sum'] : 0;
            $mappedBudgets[] = $budget;
        }

        return $mappedBudgets;
    }

}
