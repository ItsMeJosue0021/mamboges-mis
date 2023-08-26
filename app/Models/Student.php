<?php

namespace App\Models;

use App\Models\Score;
use App\Models\ActivityStatistics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    // public function classRecord()
    // {
    //     return $this->belongsTo(ClassRecord::class);
    // }

    // public function classRecordEvaluationCriteria()
    // {
    //     return $this->belongsTo(ClassRecordEvaluationCriteria::class);
    // }

    public function activityStatistics()
    {
        return $this->hasMany(ActivityStatistics::class);
    }

    public function scopeFilter($query, array $filters) {

        if ($filters['search'] ?? false) {
            $query->where('first_name', 'like', '%' . request('search') . '%' )
            ->orWhere('last_name', 'like', '%' . request('search') . '%' )
            ->orWhere('middle_name', 'like', '%' . request('search') . '%' )
            ->orwhere('grade_level', request('search') );
        }

        if ($filters['grade_level'] ?? false) {
            $query->where('grade_level', request('grade_level') );
        }
    }
}
