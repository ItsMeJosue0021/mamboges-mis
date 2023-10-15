<?php

namespace App\Models;

use App\Models\OrgChartRow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgChartRowItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'image',
        'org_chart_row_id',
    ];

    public function orgChartRow()
    {
        return $this->belongsTo(OrgChartRow::class);
    }
}
