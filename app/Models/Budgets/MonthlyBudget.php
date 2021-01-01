<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\Transaction;
use \Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class MonthlyBudget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'budget_id', 'amount', 'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function transactions()
    {
        return $this->hasMany("App\Models\Transactions\Transaction");
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function budget()
    {
        return $this->belongsTo('App\Modules\Budgets\Budget');
    }

    public function monthlyTotal()
    {
        return Transaction::toUser()->where('category', $this->category)->where('exclude', 0)->where('date', '>=', \Carbon\Carbon::now()->firstOfMonth())->get()->sum('amount');
    }

    public function previousMonthlyTotal()
    {
        return Transaction::toUser()->where('category', $this->category)->where('exclude', 0)->where('date', '<=', \Carbon\Carbon::now()->firstOfMonth())
                    ->where('date', '>=', \Carbon\Carbon::now()->subMonths(1)->firstOfMonth())
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
