<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('admin_email');
            $table->string('additional_admin_emails');
            $table->boolean('email_new_member');
            $table->boolean('email_weekly_report');
            $table->boolean('email_daily_report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_site_settings');
    }
}
