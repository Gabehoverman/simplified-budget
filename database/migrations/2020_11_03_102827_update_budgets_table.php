<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->float('amount', 12, 2)->nullable()->change();
            $table->string('category')->nullable()->change();
            $table->integer('account_id')->default(0)->change();
            $table->integer('timeframe')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->string('name');
            $table->integer('amount')->change();
            $table->string('category')->change();
            $table->integer('account_id')->change();
            $table->dropColumn('timeframe');
        });
    }
}
