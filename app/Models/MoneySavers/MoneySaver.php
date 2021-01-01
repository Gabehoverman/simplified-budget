<?php

namespace App\Models\MoneySavers;

use Illuminate\Database\Eloquent\Model;

class MoneySaver extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id', 'vendor', 'link', 'name', 'rating', 'recommended', 'category', 'features', 'details', 'our_take', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'features' => 'json',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function type()
    {
        return $this->belongsTo(MoneySaverType::class, 'type_id');
    }
}
