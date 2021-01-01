<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
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
        $this->middleware('billing-verification');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.profile');
    }

    public function update( Request $request )
    {
        $user = \Auth::User();
        $data = $request->input();

        if (isset($data['password']) && !\Hash::check($data['password'], $user->password)) {
            $data['password'] = \Hash::make($data['password']);
        } else {
            $data['password'] = \Auth::User()->password;
        }

        $user->update($data);

        return response(json_encode($user), 200);
    }
}
