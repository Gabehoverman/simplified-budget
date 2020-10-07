<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Institutions\InstitutionRepository;
use App\Models\MX\MXRepository;
use Carbon\Carbon;
use atrium\api\AtriumClient;
use GuzzleHttp\Client;
use Auth;

class AccountsController extends Controller
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
    public function index()
    {
        $accounts = Account::where('user_id', Auth::User()->id)->with('transactions', 'institution')->get();

        return view('user.accounts', array('accounts' => $accounts));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new(InstitutionRepository $institutionRepository, $step = null, $id = null)
    {
        $account = [];
        if ( $id ) {
            $account = Account::find( $id );
        }
        $institutions = $institutionRepository->getInstitutions();

        return view('user.new-account', compact( 'account', 'institutions'));
    }

    /**
     * Shows a Specific Account
     *
     */
    public function show( Request $request, $id, InstitutionRepository $institutionRepository )
    {
        $account = Account::where('id', $id)->with('institution')->first();
        $transactions = $account->transactions->groupBy(function($date) {
            return Carbon::parse($date->date)->format('F'); // grouping by month
        })->reverse();
        $institutions = $institutionRepository->getInstitutions();

        return view('user.show-account', compact('account', 'transactions', 'institutions'));
    }

    /**
     * Edit an account
     *
     */
    public function edit( Request $request, $id )
    {
        $account = Account::find($id);

        return view('user.edit-account', compact('account'));
    }

      /**
     * Creates a new Account
     *
     * @return Account
     */
    public function store( Request $request, $member_guid = null )
    {
        $account = new Account( $request->input() );
        $account->institution_id = $request->input( 'institution_id' );
        $account->user_id = \Auth::User()->id;
        $account->save();

        return response(json_encode($account), 200);
    }

    /**
     * Updates an Account
     *
     * @return Account
     */
    public function update( $id, Request $request )
    {
        $account = Account::find($id);
        $account->update( $request->input() );
        $account->institution;

        return response(json_encode($account), 200);
    }

    /**
     * Deletes an Account
     *
     * @return Account
     */
    public function destroy( $id )
    {
        $account = Account::find($id);
        $user_guid = $account->user->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.

        if ($account->mx_member_guid) {
            try {
                $result = $this->client->members->deleteMember($account->mx_member_guid, $user_guid);
            } catch (\Exception $e) {
                // continue
            }
        }
        if ($account->transactions) {
            $account->transactions()->delete();
        }
        $account->delete();

        return response(200);
    }

    /**
     * Updates an Account & pulls in new transactions from MX
     *
     * @return Account
     */
    public function sync( $id, Request $request, MXRepository $mXRepository )
    {
        $account = Account::find($id);
        $account->update( $request->input() );
        $account->institution;

        $mXRepository->syncTransactions($account);

        return response(json_encode($account), 200);
    }
}
