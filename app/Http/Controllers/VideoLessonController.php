<?php

namespace App\Http\Controllers;

use App\Models\VideoLesson;
use Illuminate\Http\Request;

class VideoLessonController extends Controller
{
    public function index()
    {
        return view('videolessons.index', [
            'videolessons' => VideoLesson::latest()->filter(Request(['topic', 'grade']))->simplePaginate(9),
        ]);
    }

    public function show()
    {
        return view('video-lesson');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'title' => 'required{string|max:255}',
            'description'=> 'nullable|string',
            'topic' => 'required',
            'grade' => 'required',
            // 'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'required|mimetypes:video/*|max:5369709120',
        ]);

        try {
            $videoPath = $request->file('video')->store('videos', 'public');

            // $thumbnailPath = null;
            // if ($request->hasFile('thumbnail')) {
            //     $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            // }

            $video = VideoLesson::create([
                'title' => $request->title,
                'description' => $request->description,
                'topic' => $request->topic,
                'grade' => $request->grade,
                // 'thumbnail' => $thumbnailPath,
                'video' => $videoPath,
            ]);

            return redirect()->back()->with('success', 'Video lesson successfully uploaded.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
