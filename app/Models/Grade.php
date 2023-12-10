<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_record_id',
        'quarter_id',
        'section_id',
        'subject_id',
        'school_year_id',
        'remarks',
        'grade',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function classRecord() {
        return $this->belongsTo(ClassRecord::class);
    }

    public function quarter() {
        return $this->belongsTo(Quarter::class);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }

    public function subject() {
        return $this->belongsTo(Subjects::class);
    }
    public function students() {
        return $this->belongsTo(Student::class);
    }

    public function schoolYear() {
        return $this->belongsTo(SchoolYear::class);
    }

}
