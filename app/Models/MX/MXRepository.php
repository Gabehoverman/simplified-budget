<?php

namespace App\Models\MX;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionType;
use atrium\api\AtriumClient;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Auth;

class MXRepository extends Model
{
    public function __construct() {
        // $this->model = $transaction;
        $this->client = new AtriumClient(
            env('MX_API_KEY'),
            env('MX_CLIENT_ID'),
            new Client()
        );
    }

    public function generateUserGuid( $user = null ) {
        $user = array(
            'identifier' => $user ? $user->id : Auth::User()->id,
            'is_disabled' => false,
            'metadata' => null
        );

        $body = new \atrium\model\UserCreateRequestBody(['user' => $user]);

        try {
            $result = $this->client->users->createUser($body);
            $data = json_decode($result);
        } catch (\Exception $e) {
            echo 'Exception when calling UsersApi->createUser: ', $e->getMessage(), PHP_EOL;
        }

        return $data->user->guid;
    }

    public function fetchDailyTransactions( $account ) {
        $user_guid = $account->user->mx_user_guid;
        $to_date = Carbon::now()->format('Y-m-d');
        $from_date = Carbon::now()->subDays(1)->format('Y-m-d');
        $page = 1;
        $records_per_page = 1000;

        try {
            $result = $this->client->members->listMemberTransactions($account->mx_member_guid, $user_guid, $from_date, $to_date, $page, $records_per_page);
            $data = $result;
        } catch (\Exception $e) {
            echo 'Exception when calling MembersApi->listMemberTransactions: ', $e->getMessage(), PHP_EOL;
        }

        $data = [];
        foreach ( $result['transactions'] as $transaction) {
            $tran = $this->findOrSave( $transaction, $account );
            $data[] = $tran;
        }

        return $data;
    }

    public function syncTransactions( $account ) {

        $user_guid = $account->user->mx_user_guid; // string | The unique identifier for a `user`.
        $to_date = Carbon::now()->format('Y-m-d'); // string | Filter transactions to this date.
        $from_date = Carbon::now()->firstOfMonth()->format('Y-m-d'); // string | Filter transactions from this date.
        $page = 1; // int | Specify current page.
        $records_per_page = 1000; // int | Specify records per page.

        try {
            $result = $this->client->members->listMemberTransactions($account->mx_member_guid, $user_guid, $from_date, $to_date, $page, $records_per_page);
            $data = $result;
        } catch (\Exception $e) {
            echo 'Exception when calling MembersApi->listMemberTransactions: ', $e->getMessage(), PHP_EOL;
        }

        $data = [];
        foreach ( $result['transactions'] as $transaction) {
            $tran = $this->findOrSave( $transaction, $account );
            $data[] = $tran;
        }

        return $data;
    }

    public function findOrSave( $transaction, $account ) {
        if ( Transaction::where('mx_transaction_guid', $transaction['guid'] )->first() ) {
            return Transaction::where('mx_transaction_guid', $transaction['guid'] )->first();
        }
        $tran = new Transaction();
        $tran->account_id = $account->id;
        $tran->user_id = $account->user_id;
        $tran->mx_transaction_guid = $transaction['guid'];
        $tran->category = $transaction['top_level_category'];
        $tran->amount = $transaction['amount'];
        $tran->vendor = $transaction['description'];
        $tran->type = $this->mapTransactionType( $transaction );
        $tran->date = Carbon::parse( $transaction['transacted_at'] );
        $tran->save();

        return $tran;
    }

    public function mapTransactionType( $transaction ) {
        if ( $transaction['is_income'] ) {
            return TransactionType::TYPE_INCOME;
        } else if ( $transaction['is_fee']) {
            return TransactionType::TYPE_FEE;
        } else if ( $transaction['top_level_category'] == 'Transfer') {
            return TransactionType::TYPE_TRANSFER;
        } else {
            return TransactionType::TYPE_EXPENSE;
        }
    }

}
