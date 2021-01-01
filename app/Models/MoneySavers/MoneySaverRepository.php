<?php

namespace App\Models\MoneySavers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\TransactionRepository;
use App\Models\MoneySavers\MoneySaver;
use Carbon\Carbon;
use Auth;

use function Ramsey\Uuid\v1;

class MoneySaverRepository extends Model
{
    public function __construct( MoneySaver $moneySavers, TransactionRepository $transactionsRepository, MoneySaverType $moneySaverTypes, CastedTypes $castedTypes ) {
        $this->model = $moneySavers;
        $this->types = $moneySaverTypes;
        $this->transactions = $transactionsRepository;
        $this->castedTypes = $castedTypes;
    }

    public function getMoneySavers()
    {
        return $this->model->where('status', $this->model::STATUS_ACTIVE)->get();
    }

    public function getRecommendedMoneySavers()
    {
        $recommended = [];
        $moneySavers = $this->model->where('status', $this->model::STATUS_ACTIVE)->orderBy('recommended', 'DESC')->get();
        foreach($moneySavers as $saver) {
            // Check each rule & return recommended
            $rules = $saver->type->rules;
            $valid = true;
            foreach( $rules as $rule ) {
                $model = $this->getModel( $rule['model'] );

                switch ( $rule['type'] ) {
                    case 'CMP': // Scope Rules
                        $result = $model::whereNotNull($rule['field'])->where($rule['field'], $rule['comparison'], $saver->{ $rule['feature'] } )
                                                    ->where($this->getScope($rule['model']), \Auth::User()->id)->first();
                        if (!$result) {
                            $valid = false;
                        }
                        break;
                    case 'CST': // Global Rules
                        $query = $rule['feature'];
                        $result = $model::whereNotNull($rule['field'])->where($rule['field'], $rule['comparison'], $query )
                                                    ->where($this->getScope($rule['model']), \Auth::User()->id)->first();
                        if (!$result) {
                            $valid = false;
                        }
                        break;
                }
            }

            if ($valid) {
                $recommended[] = $saver;
            }
        }

        return $recommended;
    }

    public function getAdminMoneySavers()
    {
        return $this->model->get();
    }

    public function getAllMoneySaverTypes()
    {
        return $this->types->get();
    }

    public function getMoneySaverByVendor( $vendor )
    {
        return $this->model->where('vendor', $vendor)->first();
    }

    public function getUserMoneySavers( $user = null )
    {
        if (!$user) {
            $user = Auth::User();
        }
        return $this->model->where('user_id', Auth::User()->id)->get();
    }

    public function createMoneySaver( $vendor, $category )
    {
        $moneySaver = $this->getMoneySaverByVendor( $vendor );
        if ( !$moneySaver ) {
            $moneySaver = new $this->model;
            $moneySaver->vendor = $vendor;
            $moneySaver->user_id = Auth::User()->id;
        }

        $moneySaver->category = $category;
        $moneySaver->save();

        return $moneySaver;
    }

    public function getModel( $model ) {
        if ( $model == 'User') {
            return 'App\\'.$model;
        } else {
            return  $model = 'App\\Models\\'.$model;
        }
    }

    public function getScope( $model ) {
        if ( $model == 'User') {
            return 'id';
        } else {
            return  'user_id';
        }
    }
}
