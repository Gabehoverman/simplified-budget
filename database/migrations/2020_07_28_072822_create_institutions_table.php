<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('asset')->nullable();
            $table->integer('status');
            $table->timestamps();
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->integer('institution_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');

        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('institution_id');
        });
    }
}
