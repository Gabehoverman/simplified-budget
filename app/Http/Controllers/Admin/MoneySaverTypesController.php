<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MoneySavers\MoneySaverRepository;
use App\Models\MoneySavers\MoneySaverType;
use Auth;


class MoneySaverTypesController extends Controller
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
        // nada
    }

    /**
     * Creates a new Budget
     *
     * @return Budget
     */
    public function store( Request $request )
    {
        $moneySaverType = new MoneySaverType($request->input());
        $moneySaverType->save();

        return response(json_encode($moneySaverType), 200);
    }


    public function update( Request $request )
    {
        $moneySaverType = MoneySaverType::find( $request->input('id') );
        $moneySaverType->update( $request->input() );
        $moneySaverType->save();

        return response(json_encode($moneySaverType), 200);
    }

    /**
     * Deletes a Budget
     *
     * @return Budget
     */
    public function destroy( $id )
    {
        $moneySaverType = MoneySaverType::find($id);
        $moneySaverType->delete();

        return response(200);
    }
}
