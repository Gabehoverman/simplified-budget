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

}
