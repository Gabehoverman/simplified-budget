<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MoneySavers\MoneySaverRepository;
use App\Models\MoneySavers\MoneySaver;
use App\Models\Institutions\Institution;
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
        $this->moneySavers = $moneySaverRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $moneySavers = $this->moneySavers->getMoneySavers();
        $moneySaverTypes = $this->moneySavers->getAllMoneySaverTypes();
        $institutions = Institution::where('status', 1)->get();

        return view('admin.money-savers', compact('moneySavers', 'moneySaverTypes', 'institutions'));
    }

    /**
     * Creates a new Budget
     *
     * @return Budget
     */
    public function store( Request $request )
    {
        $moneySaver = new MoneySaver($request->input());
        $moneySaver->save();

        return response(json_encode($moneySaver), 200);
    }


    public function update( Request $request )
    {
        $moneySaver = MoneySaver::find( $request->input('id') );
        $moneySaver->update( $request->input() );
        $moneySaver->save();

        return response(json_encode($moneySaver), 200);
    }

    /**
     * Deletes a Budget
     *
     * @return Budget
     */
    public function destroy( $id )
    {
        $moneySaver = MoneySaver::find($id);
        $moneySaver->delete();

        return response(200);
    }
}
