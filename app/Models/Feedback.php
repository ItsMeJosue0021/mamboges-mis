<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters) {

        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%' )
            ->orWhere('email', 'like', '%' . request('search') . '%' )
            ->orWhere('message', 'like', '%' . request('search') . '%' );
        }
    }
}
