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
        return $this->belongsToMany(EvaluationCriteria::class, 'class_record_evaluation_criterias')
                    ->withPivot('name')
                    ->withPivot('percentage');
    }

    public function classRecordEvaluationCriterias()
    {
        return $this->hasMany(ClassRecordEvaluationCriteria::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
