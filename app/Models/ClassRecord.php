<?php

namespace App\Models;

use App\Models\EvaluationCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRecord extends Model
{
    use HasFactory;

    public function evaluationCriterias()
    {
        return $this->hasMany(EvaluationCriteria::class);
    }
}
