<?php

namespace App\Models;

use App\Models\OrgChartRowItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgChartRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function orgChartRowItems()
    {
        return $this->hasMany(OrgChartRowItem::class);
    }
}
