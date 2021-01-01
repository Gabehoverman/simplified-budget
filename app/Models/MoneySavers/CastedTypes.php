<?php

namespace App\Models\MoneySavers;

use Illuminate\Database\Eloquent\Model;

class CastedTypes extends Model
{
    const TYPE_EXPENSE = 0;
    const TYPE_INCOME = 1;
    const TYPE_TRANSFER = 2;
    const TYPE_FEE = 3;

    public static $fieldToType = [
        'balance' => 'integer',
        'name' => 'string',
        'institution' => 'integer',
        'interest' => 'float',
        'type' => 'integer',
        'category' => 'string',
        'amount' => 'integer',

        'plan' => 'string',
        'income' => 'float',
        'pay' => 'float'
    ];

    public function getCastedType( $field ) {
        if ( isset ( self::$fieldToType[$field] ) )  {
            return self::$fieldToType[$field];
        }

        return 'string';
    }
}
