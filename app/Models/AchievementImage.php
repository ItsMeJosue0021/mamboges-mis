<?php

namespace App\Models;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AchievementImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }
}
