<?php

namespace App\Models;

use App\Models\AchievementImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'coverPhoto',
    ];

    public function achievementImages()
    {
        return $this->hasMany(AchievementImage::class);
    }
}
