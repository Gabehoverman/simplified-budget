<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    const AUTO_TRANSPORT = 'Auth & Transport';
    const BILLS_UTILITIES = 'Bills & Utilities';
    const BUSINESS_SERVICERS = 'Business Services';
    const EDUCATION = 'Education';
    const ENTERTAINMENT = 'Entertainment';
    const FEES_CHARGES = 'Fees & Charges';
    const FINANCIAL = 'Financial';
    const FOOD_DINING = 'Food & Dining';
    // const GROCERIES = 'Groceries';
    const GIFTS_DONATIONS = 'Gifts & Donations';
    const HEALTH_FITNESS = 'Health & Fitness';
    const HOME = 'Home';
    // const HOUSING = 'Rent / Mortgage';
    const IVESTMENTS = 'Investments';
    // const RESTAURANTS = 'Restaurants';
    const KIDS = 'Kids';
    const PERSONAL_CARE = 'Personal Care';
    const PETS = 'Pets';
    const SHOPPING = 'Shopping';
    // const TRANSPORTATION = 'Transporation';
    const TAXES = 'Taxes';
    const TRANSFER = 'Transfer';
    const TRAVEL = 'Travel';
    const OTHER = 'Other';
    const UNCATEGORIZED = 'Uncategorized';
    const INCOME = 'Income';
}
