<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ModuleController extends Controller
{
    public function store(Request $request) {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'topic' => 'required',
            'grade' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'file' => 'required',
        ]);

        $thumbnailPath = $request->hasFile('thumbnail') ? $request->file('thumbnail')->store('thumbnails', 'public') : null;
        $filePath = $request->file('file')->store('modules', 'public');

        $module = Module::create([
            'title' => $request->title,
            'description' => $request->description,
            'topic' => $request->topic,
            'grade' => $request->grade,
            'thumbnail' => $thumbnailPath,
            'file' => $filePath
        ]);

        if (!$module) {
            return redirect()->back()->with('error', 'Module Cannot Be Uploaded.');
        }
        return redirect()->back()->with('success', 'Module Uploaded Successfully!');
    }

    public function view($file)
    {

        $file = Module::find($file);
        $fileName = $file->file;

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
