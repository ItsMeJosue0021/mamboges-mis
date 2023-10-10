<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot',
        'block',
        'street',
        'subdivision',
        'barangay',
        'city',
        'province',
        'zipCode',
        'profile_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
