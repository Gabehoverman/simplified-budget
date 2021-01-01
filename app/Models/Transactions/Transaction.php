<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id', 'user_id', 'type', 'amount', 'vendor', 'category', 'date',
        'mx_transaction_guid', 'exclude', 'sub_category'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function account()
    {
        return $this->belongsTo("App\Models\Account");
    }

    public function scopeToUser( $query ) {
        return $query->where('user_id', \Auth::User()->id);
    }
}
