<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Orders;
use App\Models\MX\MXRepository;

class SyncDailyTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:syncdaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Daily Transactions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle( MXRepository $mxRepository)
    {
        try {
            $count = 0;
            foreach ( User::all() as $user ) {
                foreach ( $user->accounts()->whereNotNull('mx_member_guid')->where('active', true)->get() as $account ) {
                    $transactions = $mxRepository->fetchDailyTransactions( $account );
                    $count += count( $transactions );
                }
            }
            activity('mx_transactions')->withProperties(['transactionCount' => $count])->log('New daily transactions added');
        } catch ( \Exception $e) {
            activity('mx_transactions')->withProperties(['error' => $e->getMessage()])->log('An error occured while processing daily transactions: ');
        }
    }
}
