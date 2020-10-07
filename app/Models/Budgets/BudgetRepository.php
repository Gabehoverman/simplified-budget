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

    public function generateNotifications( $budgets )
    {
        foreach( $budgets as $budget ) {
            $percent = $budget->getMonthlyPercentage();

            if ( $percent >= 85 && $percent < 100 ) {
                $budget->createNotification('Your '.$budget->name.' budget is approaching the monthly limit');
            } else if ($percent >= 100) {
                $budget->createNotification('Your '.$budget->name.' budget exceeded the monthly limit');
            }
        }
    }
}
