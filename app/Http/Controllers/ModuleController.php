<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ModuleController extends Controller
{
    public function index() {
        $modules = Module::latest()->filter(Request(['grade', 'search']))->paginate(12);

        return view('lr.web-modules', [
            'modules' => $modules,
        ]);
    }
    public function create() {
        return view('lr.module', [
            'subjects' => Subjects::all(),
            'modules' => Module::all(),
        ]);
    }
    public function edit($moduleId)
    {
        $module = Module::find($moduleId);
        return view('lr.edit-module', [
            'module' => $module,
            'subjects' => Subjects::all(),
        ]);
    }

    public function store(Request $request)
    {
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
            return back()->with('error', 'Module Cannot Be Uploaded.');
        }
        return back()->with('success', 'Module Uploaded Successfully!');
    }

    public function update(Request $request, $moduleId)
    {
        // dd($request->all());
        $module = Module::find($moduleId);
        if (!$module) {
            return back()->with('error', 'Module not found.');
        }

        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'topic' => 'required',
            'grade' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'file' => 'nullable',
        ]);

        $thumbnailPath = $request->hasFile('thumbnail') ? $request->file('thumbnail')->store('thumbnails', 'public') : $module->thumbnail;
        $filePath = $request->hasFile('file') ? $request->file('file')->store('modules', 'public') : $module->file;

        $moduleUpdated = $module->update([
            'title' => $request->title,
            'description' => $request->description,
            'topic' => $request->topic,
            'grade' => $request->grade,
            'thumbnail' => $thumbnailPath,
            'file' => $filePath
        ]);

        if (!$moduleUpdated) {
            return back()->with('error', 'Unable to update the module. Please try again.');
        }
        return back()->with('success', 'Module Updated Successfully!');
    }

    public function delete($moduleId)
    {
        $module = Module::find($moduleId);
        if (!$module) {
            return back()->with('error', 'Module not found.');
        }

        if (!$module->delete()) {
            return back()->with('error', 'Unable to delete the module. Please try again.');
        }
        return back()->with('success', 'The module has been deleted.');

    }

    public function view($file)
    {

        $file = Module::find($file);
        $fileName = $file->file;

        $filePath = public_path('storage/' . $fileName);

        if (file_exists($filePath)) {
            return Response::stream(function () use ($filePath, $fileName) {
                echo '<html><head><title>Custom Title</title>';
                echo '</head><body>';
                echo '<script type="text/javascript">';
                echo 'document.title = "' . $fileName . '";';
                echo '</script>';
                readfile($filePath);
                echo '</body></html>';
            }, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            ]);
        } else {
            return back()->with('error', 'PDF file not found');
        }
    }

}
