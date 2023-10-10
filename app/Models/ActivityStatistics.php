<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassRecordEvaluationCriteria;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_record_evaluation_criteria_id',
        'total',
        'ps',
        'ws',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classRecordEvaluationCriteria()
    {
        return $this->belongsTo(ClassRecordEvaluationCriteria::class);
    }
}
