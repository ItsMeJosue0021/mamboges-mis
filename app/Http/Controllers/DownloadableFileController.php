<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DownloadableFile;
use App\Models\DownloadableFilesGroup;
use Illuminate\Support\Facades\Response;

class DownloadableFileController extends Controller
{
    public function index()
    {
        $groups = DownloadableFilesGroup::latest()->paginate(9);
        return view('downloadables.index', [
            'groups' => $groups,
        ]);
    }

    public function list()
    {
        $groups = DownloadableFilesGroup::latest()->paginate(9);

        return view('downloadables.list', [
            'groups' => $groups,
        ]);
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

        return back()->with('message', 'No files were uploaded.');
    }

    public function edit($id)
    {
        return view('downloadables.edit', [
            'group' => DownloadableFilesGroup::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $group = DownloadableFilesGroup::find($id);

        if (!$group) {
            return back()->with('error', 'Failed to update the group. Please try again.');
        }

        $group->name = $request->groupName;
        $group->save();

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

        return back()->with('message', 'No files were uploaded.');
    }


    public function destroy($id)
    {
        $file = DownloadableFile::find($id);

        if (!$file) {
            return back()->with('error', 'Failed to delete the file. Please try again.');
        }

        $file->delete();

        return back()->with('success', 'File deleted successfully.');
    }

    public function viewPDF($file)
    {

        $file = DownloadableFile::find($file);
        $fileName = $file->fileName;

        $filePath = public_path('storage/' . $fileName);

        if (file_exists($filePath)) {
            return Response::stream(function () use ($filePath) {
                readfile($filePath);
            }, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            ]);
        } else {
            return back()->with('error', 'PDF file not found');
        }

    }

}
