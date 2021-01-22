<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalAccountFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->double('apr', 10,6)->after('mx_institution_code')->nullable();
            $table->double('apy', 10,6)->after('apr')->nullable();
            $table->double('available_credit', 14,2)->after('balance')->nullable();
            $table->double('cash_balance', 14,2)->after('available_credit')->nullable();
            $table->double('cash_surrender_value', 14,2)->after('cash_balance')->nullable();
            $table->double('credit_limit', 10,2)->after('cash_surrender_value')->nullable();
            $table->integer('day_payment_is_due')->after('credit_limit')->nullable();
            $table->double('holdings_value')->after('day_payment_is_due')->nullable();
            $table->double('interest_rate' ,10,6)->after('holdings_value')->nullable();
            $table->boolean('is_closed')->after('interest_rate')->nullable();
            $table->double('last_payment', 10,2)->after('is_closed')->nullable();
            $table->string('last_payment_at')->after('last_payment')->nullable();
            $table->double('loan_amount', 14,2)->after('last_payment_at')->nullable();
            $table->string('matures_on')->after('loan_amount')->nullable();
            $table->double('minimum_balance', 14,2)->after('matures_on')->nullable();
            $table->double('minimum_payment', 10,2)->after('minimum_balance')->nullable();
            $table->double('original_balance', 14,2)->after('minimum_payment')->nullable();
            $table->string('payment_due_at')->after('original_balance')->nullable();
            $table->double('payoff_balance', 14,2)->after('payment_due_at')->nullable();
            $table->string('started_on')->after('payoff_balance')->nullable();
            $table->string('subtype')->after('started_on')->nullable();
            $table->double('total_account_value', 14, 2)->after('subtype')->nullable();
            $table->string('mx_type')->after('total_account_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('apr')->nullable();
            $table->dropColumn('apy')->nullable();
            $table->dropColumn('available_credit')->nullable();
            $table->dropColumn('cash_surrender_value')->nullable();
            $table->dropColumn('credit_limit')->nullable();
            $table->dropColumn('day_payment_is_due')->nullable();
            $table->dropColumn('holdings_value')->nullable();
            $table->dropColumn('interest_rate')->nullable();
            $table->dropColumn('is_closed')->nullable();
            $table->dropColumn('last_payment')->nullable();
            $table->dropColumn('last_payment_at')->nullable();
            $table->dropColumn('loan_amount')->nullable();
            $table->dropColumn('matures_on')->nullable();
            $table->dropColumn('minimum_balance')->nullable();
            $table->dropColumn('minimum_payment')->nullable();
            $table->dropColumn('original_balance')->nullable();
            $table->dropColumn('payment_due_at')->nullable();
            $table->dropColumn('payoff_balance')->nullable();
            $table->dropColumn('started_on')->nullable();
            $table->dropColumn('subtype')->nullable();
            $table->dropColumn('total_account_value')->nullable();
            $table->dropColumn('mx_type')->nullable();
        });
    }
}
