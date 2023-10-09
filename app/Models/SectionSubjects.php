<?php

namespace App\Models;

use App\Models\Faculty;
use App\Models\Section;
use App\Models\Subjects;
use App\Models\SchoolYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionSubjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'subject_id',
        'faculty_id',
        'school_year_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function classRecords()
    {
        return $this->hasMany(ClassRecord::class);
    }
}
