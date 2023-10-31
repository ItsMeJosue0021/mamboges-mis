<?php

namespace App\Models;

use App\Models\User;
use App\Models\Section;
use App\Models\Department;
use App\Models\SectionSubjects;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'department_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function section()
    {
        return $this->hasOne(Section::class);
    }

    public function sectionSubjects()
    {
        return $this->hasMany(SectionSubjects::class);
    }


    public function scopeFilter($query, array $filters)
    {

        if ($filters['search'] ?? false) {
            $query->where('first_name', 'like', '%' . request('search') . '%')
                ->orWhere('last_name', 'like', '%' . request('search') . '%')
                ->orWhere('middle_name', 'like', '%' . request('search') . '%');
        }
    }
}