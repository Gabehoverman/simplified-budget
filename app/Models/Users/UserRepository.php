<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class UserRepository extends Model
{
    public function __construct( User $user ) {
        $this->model = $user;
    }

    public function getWeeklyNewUsers()
    {
        return $this->model->where('created_at', '>=', Carbon::now()->startOfWeek())->orderBy('created_at', 'ASC')->get()->groupBy(function($user) {
            return Carbon::parse($user->created_at)->format('d'); // grouping by day
        });
    }

    public function getMonthlyNewUsers() {
        return $this->model->where('created_at', '>=', Carbon::now()->firstOfMonth())->orderBy('created_at', 'ASC')->get()->groupBy(function($user) {
            return Carbon::parse($user->created_at)->format('d'); // grouping by month
        });
    }

    public function getAnnualNewUsers() {
        return $this->model->where('created_at', '>=', Carbon::now()->firstOfYear())->orderBy('created_at', 'ASC')->get()->groupBy(function($user) {
            return Carbon::parse($user->created_at)->format('m-d'); // grouping by month-day
        });
    }

}
