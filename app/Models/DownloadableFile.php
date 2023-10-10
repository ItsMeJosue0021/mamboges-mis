<?php

namespace App\Models;

use App\Models\DownloadableFilesGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DownloadableFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file',
        'downloadable_files_group_id',
    ];

    public function downloadableFilesGroup()
    {
        return $this->belongsTo(DownloadableFilesGroup::class);
    }
}
