<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownloadableFile;
use App\Models\DownloadableFilesGroup;

class DownloadableFileController extends Controller
{
    public function index()
    {
        return view('downloadables.index');
    }

    public function list()
    {
        return view('downloadables.list');
    }

    public function show($file)
    {
        $path = storage_path('app/public/' . $file);
        return response()->download($path);
    }

    public function store(Request $request)
    {
        $group = DownloadableFilesGroup::create([
            'name' => $request->groupName,
        ]);

        if (!$group) {
            return back()->with('error', 'Failed to create the group. Please try again.');
        }

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $names = $request->names;

            if (count($files) === count($names)) {
                foreach ($files as $index => $file) {
                    $name = $names[$index];
                    $filePath = $file->store('downloadables', 'public');

                    $downloadableFile = DownloadableFile::create([
                        'downloadable_files_group_id' => $group->id,
                        'title' => $name,
                        'fileName' => $filePath,
                    ]);

                    if (!$downloadableFile) {
                        return back()->with('error', 'Failed to upload one or more files. Please try again.');
                    }
                }

                return back()->with('success', 'Files uploaded successfully.');
            } else {
                return back()->with('error', 'The number of files and names do not match.');
            }
        }

        return back()->with('success', 'No files were uploaded.');
    }


    public function destroy($file)
    {
        $path = storage_path('app/public/' . $file);
        if (file_exists($path)) {
            unlink($path);
        }
        return back()->with('success', 'File deleted successfully');
    }
}