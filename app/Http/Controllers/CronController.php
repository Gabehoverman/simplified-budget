<?php

namespace App\Http\Controllers;

use App\Models\MX\MXRepository;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Institutions\Institution;
use App\Models\Institutions\InstitutionRepository;
use atrium\api\AtriumClient;
use GuzzleHttp\Client;

class CronController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( MXRepository $mxRepository )
    {
        // $this->middleware('auth');
        $this->mx = $mxRepository;
        $this->client = new AtriumClient(
            env('MX_API_KEY'),
            env('MX_CLIENT_ID'),
            new Client()
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pullDailyTransactions()
    {
        //todo: iterate through users, check for MX Accounts, and pull in latest transactions
        foreach ( User::all() as $user ) {
            foreach ( $user->accounts()->whereNotNull('mx_member_guid')->where('active', true)->get() as $account ) {
                $transactions = $this->mx->fetchDailyTransactions( $account );
            }
        }
    }

    public function mapInstitutions( InstitutionRepository $institutionRepository)
    {
        $name = null; // string | This will list only institutions in which the appended string appears.
        $page = 1; // int | Specify current page.
        $records_per_page = 200; // int | Specify records per page.
        $supports_account_identification = false; // bool | Filter only institutions which support account identification.
        $supports_account_statement = false; // bool | Filter only institutions which support account statements.
        $supports_account_verification = false; // bool | Filter only institutions which support account verification.
        $supports_transaction_history = false;

        try {
            $result = $this->client->institutions->listInstitutions($name, $page, $records_per_page, $supports_account_identification, $supports_account_statement, $supports_account_verification, $supports_transaction_history);
            $response = json_decode($result);
        } catch (\Exception $e) {
            echo 'Exception when calling InstitutionsApi->listInstitutions: ', $e->getMessage(), PHP_EOL;
        }
        $data = array();
        foreach( $response->institutions as $instutition ) {
            $data[] = $institutionRepository->mapInstitution( $instutition );
        }
        var_dump($data);

    }
}
