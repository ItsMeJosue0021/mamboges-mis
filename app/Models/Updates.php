<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Updates extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function updateImages() {
        return $this->hasMany(UpdateImage::class);
    }


    public function scopeFilter($query, array $filters) {
        if ($filters['tag'] ?? false) {
            $query->where('tag', 'like', '%' . request('tag') . '%' );
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%' )
            ->orWhere('description', 'like', '%' . request('search') . '%' )
            ->orWhere('tag', 'like', '%' . request('search') . '%' );
        }
    }
}
