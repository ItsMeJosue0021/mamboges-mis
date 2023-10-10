<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\ClassRecord;
use App\Models\ActivityStatistics;
use App\Models\EvaluationCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassRecordEvaluationCriteria extends Model
{
    use HasFactory;

    public function classRecord()
    {
        return $this->belongsTo(ClassRecord::class);
    }

    public function evaluationCriteria()
    {
        return $this->belongsTo(EvaluationCriteria::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function activityStatistics()
    {
        return $this->hasMany(ActivityStatistics::class);
    }

}
