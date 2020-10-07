<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institutions\Institution;
use App\Models\Account;
use Auth;

class InstitutionsController extends Controller
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
     * Show the transactions page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = Institution::where('user_id', Auth::User()->id)->with('account')->get();

        return view('user.transactions', array('transactions'=>$transactions, 'accounts' => $accounts));
    }


    /**
     * Shows a Institution
     *
     * @param [Integer] $id
     * @return Institution
     */
    public function show( $id )
    {
        $institution = Institution::find($id);

        return response(json_encode($institution), 200);
    }

    /**
     * Creates a new Institution
     *
     * @return Institution
     */
    public function store( Request $request )
    {
        $institution = new Institution($request->input());
        // $file = \Request::Input('asset');
        // $file->move('uploads/'.Auth::User()->id.'/documents', $file->getClientOriginalName());
        $institution->save();

        return response(json_encode($institution), 200);
    }

    /**
     * Updates a Institution
     *
     * @return Institution
     */
    public function update( $id, Request $request )
    {
        $institution = Institution::find($id);
        $institution->update( $request->input() );
        $institution->account;

        return response(json_encode($institution), 200);
    }

    /**
     * Deletes a Institution
     *
     * @return Institution
     */
    public function destroy( $id )
    {
        $institution = Institution::find($id);
        $institution->delete();

        return response(200);
    }
}
