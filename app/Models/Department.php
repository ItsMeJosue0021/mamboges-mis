<?php

namespace App\Models;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'faculty_id',
    ];

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }
}
