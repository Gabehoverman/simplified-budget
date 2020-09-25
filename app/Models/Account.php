<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'institution_id', 'name', 'type', 'tracking_type', 'tracking_options', 'active',
        'mx_member_guid', 'mx_institution_code'
    ];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transactions\Transaction');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Institutions\Institution');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
