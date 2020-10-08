<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Transactions\Transaction;
use App\Models\Users\UserRepository;
use Spatie\Activitylog\Models\Activity;
use Spatie\Analytics\Period;
use App\User;
use Analytics;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('notifications');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( UserRepository $userRepository )
    {
        $users = User::all();
        $analyticsData = Analytics::performQuery(
            Period::months(1),
            'ga:sessions',
            [
                'metrics' => 'ga:sessions,ga:pageviews',
                // 'dimensions' => 'ga:yearMonth'
            ]
        );

        $weeklyNewUsers = $userRepository->getWeeklyNewUsers();
        $monthlyNewUsers = $userRepository->getMonthlyNewUsers();
        $annualNewUsers = $userRepository->getAnnualNewUsers();
        $activity = Activity::where('log_name', 'like', 'mx%')->get()->take(5);

        return view('admin.dashboard', compact('users', 'weeklyNewUsers', 'monthlyNewUsers', 'annualNewUsers', 'activity', 'analyticsData'));

    }
}
