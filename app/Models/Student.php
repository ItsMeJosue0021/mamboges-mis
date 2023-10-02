<?php

namespace App\Models;

use App\Models\User;
use App\Models\Score;
use App\Models\Guardian;
use App\Models\SectionStudents;
use App\Models\ActivityStatistics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lrn',
        'user_id',
        'guardian_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }


    public function activityStatistics()
    {
        return $this->hasMany(ActivityStatistics::class);
    }

    public function sectionStudents()
    {
        return $this->hasMany(SectionStudents::class);
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
