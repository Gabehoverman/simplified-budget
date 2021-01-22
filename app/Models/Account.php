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
        'user_id', 'institution_id', 'name', 'type', 'tracking_type', 'tracking_options',
        'balance', 'active',
        'apr', 'apy', 'available_credit', 'cash_balance', 'cash_surrender_value', 'credit_limit',
        'day_payment_is_due', 'holdings_value', 'interest_rate', 'is_closed', 'last_payment',
        'last_payment_at', 'loan_amount', 'matures_on', 'minimum_balance', 'minimum_payment',
        'original_balance', 'payment_due_at', 'payoff_balance', 'started_on', 'subtype', 'total_account_value',
        'mx_type', 'mx_member_guid', 'mx_institution_code'
    ];

    const TYPE_CHECKING = 0;
    const TYPE_SAVINGS = 1;
    const TYPE_CREDIT = 2;
    const TYPE_LOAN = 3;
    const TYPE_MORTGAGE = 4;
    const TYPE_INVESTMENT = 5;

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
