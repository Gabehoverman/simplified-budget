<?php

namespace App\Models\Rules;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'vendor', 'category', 'status'
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

    // public function transactions()
    // {
    //     return $this->hasMany("App\Models\Account");
    // }
}
