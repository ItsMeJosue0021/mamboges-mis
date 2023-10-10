<?php

namespace App\Models;

use App\Models\Score;
use App\Models\EvaluationCriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function classRecord()
    {
        return $this->belongsTo(ClassRecord::class);
    }

    public function classRecordEvaluationCriteria()
    {
        return $this->belongsTo(ClassRecordEvaluationCriteria::class);
    }

}
