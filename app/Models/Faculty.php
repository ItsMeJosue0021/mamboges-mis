<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters) {

        if ($filters['search'] ?? false) {
            $query->where('first_name', 'like', '%' . request('search') . '%' )
            ->orWhere('last_name', 'like', '%' . request('search') . '%' )
            ->orWhere('middle_name', 'like', '%' . request('search') . '%' );
        }
    }
}
