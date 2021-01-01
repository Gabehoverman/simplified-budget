<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Spatie\Activitylog\Models\Activity;
use Laravel\Cashier\Billable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'password', 'notifications', 'income', 'pay', 'goals',
        'mx_user_guid', 'address', 'unit', 'city', 'state', 'zip', 'plan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accounts()
    {
        return $this->hasMany('App\Models\Account');
    }

    public function notifications()
    {
        return $this->hasMany('\Spatie\Activitylog\Models\Activity', 'causer_id');
    }

    public function getSubscriptionByPlan() {
        switch ($this->plan) {
            case 'Monthly':
                return 'price_1HmhHVArvStASqAqDwCX0tsf';
            case 'Annual':
                return 'price_1HmhgnArvStASqAqhZU8kgVk';
            default:
                return '';
        }
    }

    public function getPlan()
    {
        if ( $this->subscribedToPlan('price_1HmhHVArvStASqAqDwCX0tsf', 'subscription') && !$this->subscription('subscription')->cancelled() ) {
            return 'Monthly';
        } else if ( $this->subscribedToPlan('price_1HmhgnArvStASqAqhZU8kgVk', 'subscription') && !$this->subscription('subscription')->cancelled() ) {
            return 'Annual';
        } else {
            return 'Free';
        }
    }

    public function getBillDate()
    {
        if (!@$this->asStripeCustomer()["subscriptions"]->data) {
            $timestamp = $this->trial_ends_at;
            return \Carbon\Carbon::parse($timestamp)->toFormattedDateString();
        }
        $timestamp = $this->asStripeCustomer()["subscriptions"]->data[0]["current_period_end"];
        return \Carbon\Carbon::createFromTimeStamp($timestamp)->toFormattedDateString();
    }

    public function getInvoices()
    {
        $invoices = [];
        foreach( $this->invoices() as $invoice ) {
            $invoices[] = array(
                'label' => $invoice->billing_reason,
                'total' => $invoice->total(),
                'date' => $invoice->date()->toFormattedDateString(),
                'status' => $invoice->status
            );
        }
        return $invoices;
    }
}
