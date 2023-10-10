<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    use HasFactory;

    public function classRecords()
    {
        return $this->hasMany(ClassRecord::class);
    }
}
