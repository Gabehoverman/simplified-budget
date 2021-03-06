<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\Transaction;
use \Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class Budget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'amount', 'user_id', 'account_id', 'timeframe', 'monthly_budgets',
        'annual_amount', 'monthly_amount', 'sub_category'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'monthly_budgets' => 'json'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function accounts()
    {
        return $this->hasMany("App\Models\Transactions/Transaction");
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function monthlyBudgets()
    {
        return $this->hasMany('App\Models\Budgets\MonthlyBudget');
    }

    public function monthlyTotal( $month = null )
    {
        $start = $month ? \Carbon\Carbon::parse($month)->firstOfMonth() : \Carbon\Carbon::now()->firstOfMonth();
        $end = $month ? \Carbon\Carbon::parse($month)->endOfMonth() : \Carbon\Carbon::now()->endOfMonth();

        return Transaction::toUser()->where('category', $this->category)->where('exclude', 0)->whereDate('date', '>=', $start->format('Y-m-d'))
        ->whereDate('date', '<=', $end->format('Y-m-d'))
        ->where( function ($q) {
            if ($this->sub_category) {
                $q->where('sub_category', $this->sub_category);
            }
        })->get()->sum('amount');
    }

    public function previousMonthlyTotal( $month = null )
    {
        $start = $month ? \Carbon\Carbon::parse($month)->subMonths(1)->firstOfMonth() : \Carbon\Carbon::now()->subMonths(1)->firstOfMonth();
        $end = $month ? \Carbon\Carbon::parse($month)->firstOfMonth() : \Carbon\Carbon::now()->firstOfMonth();

        return Transaction::toUser()->where('category', $this->category)->where('exclude', 0)->whereDate('date', '<=', $end->format('Y-m-d'))
                    ->whereDate('date', '>=', $start->format('Y-m-d'))
                    ->where( function ($q) {
                        if ($this->sub_category) {
                            $q->where('sub_category', $this->sub_category);
                        }
                    })
                    ->get()
                    ->sum('amount');
    }

    public function getMonthlyPercentage()
    {
        if (!$this->total) {
            $this->total = $this->monthlyTotal();
        }

        if ( !$this->total || !$this->amount ) {
            return 0;
        }
        if ( $this->timeframe == 1) {
            return ($this->total / ( $this->amount / 12 ) ) * 100;
        }
        return ($this->total / $this->amount ) * 100;
    }

    public function createNotification( $message ) {

        if (! Activity::where('log_name' , 'budgets')->where('description', $message)->where('causer_id', $this->user->id)->whereDate('created_at', '>=', Carbon::now()->firstOfMonth()->format('Y-m-d'))->where('subject_id', $this->id)->first()  ) {
            activity('budgets')
                ->performedOn($this)
                ->causedBy($this->user)
                // ->withProperties(['laravel' => 'awesome'])
                ->log($message);
        }

        return true;
    }
}
