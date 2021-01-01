<?php

namespace App\Models\MoneySavers;

use Illuminate\Database\Eloquent\Model;

class MoneySaverType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'features', 'rules', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'features' => 'array',
        'rules' => 'array'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
}
