<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\UpdateImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Updates extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateImages()
    {
        return $this->hasMany(UpdateImage::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }


    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tag', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tag', 'like', '%' . request('search') . '%');
        }
    }
}