<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\ClassRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationCriteria extends Model
{
    use HasFactory;

    public function classRecords()
    {
        return $this->belongsToMany(ClassRecord::class, 'class_record_evaluation_criterias')
                    ->withPivot('name')
                    ->withPivot('percentage');
    }

}
