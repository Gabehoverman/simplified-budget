<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\Transaction;

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

    public function monthlyTotal()
    {
        return Transaction::groupBy('category')->toUser()->where('category', $this->category)->where('date', '>=', \Carbon\Carbon::now()->firstOfMonth())->selectRaw('sum(amount) as sum')->orderBy('sum', 'desc')->get();
    }
}
