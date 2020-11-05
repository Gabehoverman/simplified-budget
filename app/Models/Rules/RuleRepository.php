<?php

namespace App\Models\Rules;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\TransactionRepository;
use App\Models\Rules\Rule;
use Carbon\Carbon;
use Auth;

class RuleRepository extends Model
{
    public function __construct( Rule $rules, TransactionRepository $transactionsRepository ) {
        $this->model = $rules;
        $this->transactions = $transactionsRepository;
    }

    public function getRules()
    {
        return $this->model->where('user_id', Auth::User()->id)->where('status', $this->model::STATUS_ACTIVE)->get();
    }

    public function getRuleByVendor( $vendor )
    {
        return $this->model->where('user_id', Auth::User()->id)->where('vendor', $vendor)->first();
    }

    public function getUserRules( $user = null )
    {
        if (!$user) {
            $user = Auth::User();
        }
        return $this->model->where('user_id', Auth::User()->id)->get();
    }

    public function createRule( $vendor, $category )
    {
        $rule = $this->getRuleByVendor( $vendor );
        if ( !$rule ) {
            $rule = new $this->model;
            $rule->vendor = $vendor;
            $rule->user_id = Auth::User()->id;
        }

        $rule->category = $category;
        $rule->save();

        $this->transactions->applyRule( $rule );

        return $rule;
    }

}
