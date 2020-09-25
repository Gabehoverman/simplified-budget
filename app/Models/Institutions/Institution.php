<?php

namespace App\Models\Institutions;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'asset', 'status', 'mx_institution_code'
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
        return $this->hasMany("App\Models\Account");
    }
}
