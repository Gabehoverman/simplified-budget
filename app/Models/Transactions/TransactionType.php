<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    const TYPE_EXPENSE = 0;
    const TYPE_INCOME = 1;
    const TYPE_TRANSFER = 2;
    const TYPE_FEE = 3;
}
