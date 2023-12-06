<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'topic',
        'grade',
        'video'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['grade'] ?? false) {
            $query->where('grade', request('grade'));
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('grade', 'like', '%' . request('search') . '%')
                ->orWhere('topic', 'like', '%' . request('search') . '%');
        }
    }
}
