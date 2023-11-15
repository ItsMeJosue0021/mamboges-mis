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

        $path = $request->hasFile('video') ? $request->file('video')->store('videos', ['disk' => 'videos']) : null;

        $video = VideoLesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'topic' => $request->topic,
            'grade' => $request->grade,
            'video' => $path,
        ]);

        if (!$video) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
        return redirect()->back()->with('success', 'Video lesson successfully uploaded.');
    }

    public function edit($videoId) {
        $video = VideoLesson::findOrFail($videoId);
        if (!$video ) {
            return back()->with('error', 'Video not found.');
        }

        return view('lr.edit-video', [
            'video' => $video,
            'subjects' => Subjects::all(),
        ]);
    }

    public function update(Request $request, $videoId) {
        // dd($request->all());
        $video = VideoLesson::findOrFail($videoId);
        if (!$video) {
            return back()->with('error', 'Video not found.');
        }

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description'=> 'nullable|string',
            'topic' => 'required',
            'grade' => 'required',
            'video' => 'mimetypes:video/*|max:5369709120',
        ]);

        $path = $request->hasFile('video') ? $request->file('video')->store('videos', ['disk' => 'videos']) : $video->video;

        $videoUpdated = $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'topic' => $request->topic,
            'grade' => $request->grade,
            'video' => $path,
        ]);

        if (!$videoUpdated) {
            return redirect()->back()->with('error', 'Unable to update the video. Please try again.');
        }
        return redirect()->back()->with('success', 'Video lesson has been updated.');
    }

    public function delete($videoId)
    {
        $video = VideoLesson::find($videoId);
        if (!$video) {
            return back()->with('error', 'Video not found.');
        }

        if (!$video->delete()) {
            return back()->with('error', 'Unable to delete the module. Please try again.');
        }
        return back()->with('success', 'The module has been deleted.');

    }
}
