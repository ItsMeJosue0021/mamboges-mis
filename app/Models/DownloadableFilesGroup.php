<?php

namespace App\Models;

use App\Models\DownloadableFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DownloadableFilesGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function downloadableFiles()
    {
        return $this->hasMany(DownloadableFile::class);
    }
}
