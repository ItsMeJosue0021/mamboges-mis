<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
