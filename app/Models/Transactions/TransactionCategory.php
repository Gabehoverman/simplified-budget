<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    const ENTERTAINMENT = 'Entertainment';
    const FEES = 'Fees';
    const GROCERIES = 'Groceries';
    const HEALTH = 'Health';
    const HOUSING = 'Rent / Mortgage';
    const RESTAURANTS = 'Restaurants';
    const SHOPPING = 'Shopping';
    const TRANSPORTATION = 'Transporation';
    const TRANSFER = 'Transfer';
    const TRAVEL = 'Travel';
    const UTILITIES = 'Utilities';
    const OTHER = 'Other';
    const INCOME = 'Income';
}
