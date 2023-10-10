<?php

namespace App\Models;

use App\Models\Faculty;
use App\Models\SectionStudents;
use App\Models\SectionSubjects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gradeLevel',
        'faculty_id',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function sectionStudents()
    {
        return $this->hasMany(SectionStudents::class);
    }

    public function sectionSubjects()
    {
        return $this->hasMany(SectionSubjects::class);
    }


    public function scopeFilter($query, array $filters) {

        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%' );
        }
    }
}
