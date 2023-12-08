<?php

namespace App\Models;

use App\Models\Department;
use App\Models\SectionSubjects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subjects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function sectionSubjects()
    {
        return $this->belongsToMany(SectionSubjects::class);
    }

}
