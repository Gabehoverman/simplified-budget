<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transactions\Transaction;
use Auth;

class SearchController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return response(json_encode(array(1,2)));
    }

    public function accounts( Request $request )
    {
        $keyword = $request->input('keyword');
        $result = Account::where('user_id', Auth::User()->id)->where( function($q) use ($keyword) {
            $q->where('name', 'like', "%$keyword%");
        })->get();
        return response( json_encode($result) );
    }

    public function transactions( Request $request )
    {
        $keyword = $request->input('keyword');
        $result = Transaction::where('user_id', Auth::User()->id)->where( function($q) use ($keyword) {
            $q->where('vendor', 'like', "%$keyword%");
            $q->orWhere('amount', 'like', "%$keyword%");
        })->get();
        return response( json_encode($result) );
    }
}
