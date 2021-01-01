<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneySavers\MoneySaverRepository;
use App\Models\Account;
use Auth;


class MoneySaversController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( MoneySaverRepository $moneySaverRepository )
    {
        $this->middleware('auth');
        $this->middleware('notifications');
        $this->middleware('billing-verification');
        $this->moneySavers = $moneySaverRepository;
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

        return view('user.money-savers', compact('moneySavers', 'accounts'));
    }

    public function update( Request $request )
    {
        return response(json_encode($user), 200);
    }
}
