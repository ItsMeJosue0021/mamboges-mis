<?php

namespace App\Models;

use App\Models\Updates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpdateImage extends Model
{
    use HasFactory;

    public function updates()
    {
        return $this->belongsTo(Updates::class);
    }
}