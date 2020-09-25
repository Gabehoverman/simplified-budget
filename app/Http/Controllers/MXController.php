<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionRepository;
use App\Models\Institutions\Institution;
use Carbon\Carbon;
use atrium\api\AtriumClient;
use GuzzleHttp\Client;
use Auth;
use Exception;

class MXController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new AtriumClient(
            env('MX_API_KEY'),
            env('MX_CLIENT_ID'),
            new Client()
        );
    }

    //todo: Save GUID to user's table when user is created
    //todo: Use widget to connect to accounts
    //todo: Pull in accounts through membership connections, and then pull transactions through there
    //todo: Store membership identifier and account identifier in accounts table

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index( TransactionRepository $transactionRepository)
    {

        $page = 1; // int | Specify current page.
        $records_per_page = 12; // int | Specify records per page.

        try {
            $result = $this->client->users->listUsers($page, $records_per_page);
            // print_r($result);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling UsersApi->listUsers: ', $e->getMessage(), PHP_EOL;
        }

        return view('mx.index', compact('data'));
    }

    public function store()
    {
        $user = array(
            'identifier' => Auth::User()->id,
            'is_disabled' => false,
            'metadata' => null
        );

        $body = new \atrium\model\UserCreateRequestBody(['user' => $user]); // \atrium\model\UserCreateRequestBody | User object to be created with optional parameters (identifier, is_disabled, metadata)

        try {
            $result = $this->client->users->createUser($body);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling UsersApi->createUser: ', $e->getMessage(), PHP_EOL;
        }

        return view('mx.index', compact('data'));
    }

    public function destroy( $user_guid )
    {
        try {
            $this->client->users->deleteUser($user_guid);
        } catch (Exception $e) {
            echo 'Exception when calling UsersApi->deleteUser: ', $e->getMessage(), PHP_EOL;
        }

        return redirect()->back();
    }

    public function accounts()
    {
        $user_guid = Auth::User()->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.
        $page = 1; // int | Specify current page.
        $records_per_page = 12; // int | Specify records per page.

        try {
            $result = $this->client->accounts->listUserAccounts($user_guid, $page, $records_per_page);
            // print_r($result);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling AccountsApi->listUserAccounts: ', $e->getMessage(), PHP_EOL;
        }

        return view('mx.index', compact('data'));
    }

    public function members( $mx_user_guid = null )
    {
        $user_guid = $mx_user_guid ?: Auth::User()->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.
        $page = 1; // int | Specify current page.
        $records_per_page = 12; // int | Specify records per page.

        try {
            $result = $this->client->members->listMembers($user_guid, $page, $records_per_page);
            // print_r($result);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling AccountsApi->listUserAccounts: ', $e->getMessage(), PHP_EOL;
        }

        return view('mx.index', compact('data'));
    }

    public function showMember( $member_guid )
    {
        $user_guid = Auth::User()->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.

        try {
            $result = $this->client->members->readMember($member_guid, $user_guid);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling MembersApi->readMember: ', $e->getMessage(), PHP_EOL;
        }

        return ( $data );
    }

    /**
     * Creates a new account and links the $member_guid to the account
     *
     * @param String $member_guid
     * @return void
     */
    public function attachMemberAcount( $member_guid )
    {
        $user_guid = Auth::User()->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.

        try {
            $result = $this->client->members->readMember($member_guid, $user_guid);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling MembersApi->readMember: ', $e->getMessage(), PHP_EOL;
        }

        $Institution = Institution::where('mx_institution_code', '=', $data['member']['institution_code'])->first();
        // return $data;
        $account = new Account();
        $account->user_id = Auth::User()->id;
        $account->name = $data['member']['name'];
        $account->mx_member_guid = $data['member']['guid'];
        $account->mx_institution_code = $data['member']['institution_code'];
        $account->institution_id = $Institution ? $Institution->id : 0;
        $account->type = 0;
        $account->tracking_type = 1;
        $account->tracking_options = 0;
        $account->save();

        $account->instutution;

        return response( json_encode( $account ), 200 );
    }

    public function removeMember( $member_guid, $mx_guid_guid = null )
    {
        $user_guid = $mx_guid_guid ?: Auth::User()->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.

        try {
            $result = $this->client->members->deleteMember($member_guid, $user_guid);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling MembersApi->listMembers: ', $e->getMessage(), PHP_EOL;
        }

        return view('mx.index', compact('data'));
    }

    public function transactions( $member_guid, Request $request )
    {
        $user_guid = Auth::User()->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.
        $from_date = "2016-09-20"; // string | Filter transactions from this date.
        $to_date = "2020-10-20"; // string | Filter transactions to this date.
        $page = 1; // int | Specify current page.
        $records_per_page = 250; // int | Specify records per page.

        try {
            $result = $this->client->members->listMemberTransactions($member_guid, $user_guid, $from_date, $to_date, $page, $records_per_page);
            $data = json_decode( $result );
        } catch (Exception $e) {
            echo 'Exception when calling MembersApi->listMemberTransactions: ', $e->getMessage(), PHP_EOL;
        }

        if ($request->input('ajax')) {
            return response( json_encode( $data->transactions ), 200 );
        }
        print_r(json_encode($data));
        die();
        return view('mx.index', compact('data'));
    }

    public function createAccount()
    {
        $member = array(
            'identifer' => Auth::User()->id,
            'institution_code' => 'code',
            'credentials' => array(
                'username' => 'test_atrium',
                'password' => 'password'
            )
        );

        $user_guid = Auth::User()->mx_user_guid; //"USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.
        $body = new \atrium\model\MemberCreateRequestBody([ 'member' => $member ]); // \atrium\model\MemberCreateRequestBody | Member object to be created with optional parameters (identifier and metadata) and required parameters (credentials and institution_code)

        try {
            $result = $this->client->members->createMember($user_guid, $body);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling MembersApi->createMember: ', $e->getMessage(), PHP_EOL;
        }

        return view('mx.index', compact('data'));
    }

    public function widget()
    {
        $user_guid = Auth::User()->mx_user_guid; // "USR-5762d24b-d6ef-4667-9b6b-7c5c098f5034"; // string | The unique identifier for a `user`.
        $body = new \atrium\model\ConnectWidgetRequestBody([ 'color_scheme' => 'dark' ]); // \atrium\model\ConnectWidgetRequestBody | Optional config options for WebView (is_mobile_webview, current_institution_code, current_member_guid, update_credentials)

        try {
            $result = $this->client->connectWidget->getConnectWidget($user_guid, $body);
            $data = $result;
        } catch (Exception $e) {
            echo 'Exception when calling ConnectWidgetApi->getConnectWidget: ', $e->getMessage(), PHP_EOL;
        }

        // if (request()->ajax() ) {
            // var_dump($result);
            // return compact('data');
        // }

        return ( $data );

        return view('mx.index', compact('data'));
    }

    public function institutions()
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
            print_r(json_encode(json_decode($result)));
            die();
        } catch (Exception $e) {
            echo 'Exception when calling InstitutionsApi->listInstitutions: ', $e->getMessage(), PHP_EOL;
        }
    }
}


