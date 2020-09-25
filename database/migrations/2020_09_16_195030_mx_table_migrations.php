<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MxTableMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mx_user_guid')->nullable();
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->string('mx_member_guid')->nullable();
            $table->string('mx_institution_code')->nullable();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('mx_transaction_guid')->nullable();
        });

        Schema::table('institutions', function (Blueprint $table) {
            $table->string('mx_institution_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mx_user_guid');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('mx_member_guid');
            $table->dropColumn('mx_institution_code');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('mx_transaction_guid');
        });

        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn('mx_institution_code')->nullable();
        });
    }
}
