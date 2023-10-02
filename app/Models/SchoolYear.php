<?php

namespace App\Models;

use App\Models\SectionStudents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_current',
    ];

    public function sectionStudents()
    {
        return $this->hasMany(SectionStudents::class);
    }
}
