<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('sub_category')->after('category')->nullable();
        });

        Schema::table('budgets', function (Blueprint $table) {
            $table->string('sub_category')->after('category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('sub_category')->nullable();
        });

        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('sub_category')->nullable();
        });
    }
}
