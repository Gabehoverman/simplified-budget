<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Institutions\InstitutionRepository;
use App\Models\Admin\AdminSiteSettings;

class SettingsController extends Controller
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
    public function index( InstitutionRepository $institutionRepository)
    {
        $institutions = $institutionRepository->getInstitutions();
        $adminSiteSettings = AdminSiteSettings::first();
        if (!$adminSiteSettings) {
            $adminSiteSettings = new AdminSiteSettings();
            $adminSiteSettings->save();
        }
        return view('admin.settings', compact('institutions', 'adminSiteSettings'));
    }

    public function update( Request $request ) {
        $adminSiteSettings = AdminSiteSettings::first();
        $adminSiteSettings->update( $request->input() );
        $adminSiteSettings->save();

        return response( json_encode($adminSiteSettings), 200);
    }
}
