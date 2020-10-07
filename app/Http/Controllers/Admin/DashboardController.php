<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Transactions\Transaction;
use App\Models\Users\UserRepository;
use Spatie\Activitylog\Models\Activity;
use App\User;
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

        $weeklyNewUsers = $userRepository->getWeeklyNewUsers();
        $monthlyNewUsers = $userRepository->getMonthlyNewUsers();
        $annualNewUsers = $userRepository->getAnnualNewUsers();
        $activity = Activity::where('log_name', 'like', 'mx%')->get()->take(5);

        return view('admin.dashboard', compact('users', 'weeklyNewUsers', 'monthlyNewUsers', 'annualNewUsers', 'activity'));

    }
}
