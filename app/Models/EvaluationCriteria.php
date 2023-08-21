<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\ClassRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationCriteria extends Model
{
    use HasFactory;

    public function classRecord()
    {
        return $this->belongsTo(ClassRecord::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
