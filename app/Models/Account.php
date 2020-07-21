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
        'user_id', 'name', 'type', 'tracking_type', 'tracking_options', 'active',
    ];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transactions\Transaction');
    }
}
