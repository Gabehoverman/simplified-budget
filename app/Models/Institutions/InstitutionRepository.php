<?php

namespace App\Models\Institutions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Institutions\Institution;
use Carbon\Carbon;

class InstitutionRepository extends Model
{
    public function __construct( Institution $institution) {
        $this->model = $institution;
    }

    public function getInstitutions()
    {
        return $this->model->where('status', $this->model::STATUS_ACTIVE)->get();
    }

    public function mapInstitution( $instutition )
    {
        $model =  $this->model->where('name', 'LIKE', '%'.$instutition->name.'%')->first();
        if ( !$model ) {
            $model = new $this->model();
            $model->name = $instutition->name;
        }
        $model->mx_institution_code = $instutition->code;
        $model->asset = $model->asset ?: $instutition->medium_logo_url;
        $model->status = 1;
        $model->save();

        return $model;
    }

}
