<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminSiteSettings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_email', 'additional_admin_emails', 'email_new_member'. 'email_weekly_report', 'email_daily_report'
    ];
}
