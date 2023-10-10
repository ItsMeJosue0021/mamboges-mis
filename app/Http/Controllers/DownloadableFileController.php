<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        dd($request->all());

        
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
