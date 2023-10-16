<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownloadableFilesGroup;

class DownloadableFilesGroupController extends Controller
{
    public function destroy($id) {
        $group = DownloadableFilesGroup::find($id);

        if (!$group) {
            return back()->with('error', 'Failed to delete the group. Please try again.');
        }

        $files = $group->downloadableFiles;

        foreach ($files as $file) {
            $file->delete();
        }

        $group->delete();

        return back()->with('success', 'Group deleted successfully.');
    }
}
