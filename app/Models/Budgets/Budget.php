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
        'name', 'category', 'amount', 'user_id', 'account_id'
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

    public function accounts()
    {
        return $this->hasMany("App\Models\Transactions/Transaction");
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function monthlyTotal()
    {
        return Transaction::groupBy('category')->toUser()->where('category', $this->category)->where('exclude', 0)->where('date', '>=', \Carbon\Carbon::now()->firstOfMonth())->selectRaw('sum(amount) as sum')->orderBy('sum', 'desc')->get();
    }

    public function getMonthlyPercentage()
    {
        if (!$this->total) {
            $this->total = $this->monthlyTotal();
            $this->total = count($this->total) > 0 ? $this->total[0]['sum'] : 0;
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
