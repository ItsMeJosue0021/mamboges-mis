<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
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

    public function create() {
        return view('lr.video', [
            'subjects' => Subjects::all(),
        ]);
    }

    public function show()
    {
        return view('video-lesson');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description'=> 'nullable|string',
            'topic' => 'required',
            'grade' => 'required',
            'video' => 'required|mimetypes:video/*|max:5369709120',
        ]);

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos', ['disk' => 'videos']);
            $videoPath = $path;
        }

        $video = VideoLesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'topic' => $request->topic,
            'grade' => $request->grade,
            'video' => $videoPath ?? '',
        ]);

        if (!$video) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back()->with('success', 'Video lesson successfully uploaded.');
    }
}
