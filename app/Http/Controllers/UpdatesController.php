<?php

namespace App\Http\Controllers;

use App\Helpers\Logs;
use App\Models\Tag;
use App\Models\Updates;
use Illuminate\Http\Request;

class UpdatesController extends Controller
{
    public function index()
    {
        return view('updates.index', [
            'updates' => Updates::latest()->filter(Request(['tag', 'search']))->simplePaginate(9)
        ]);
    }

    public function list()
    {
        return view('updates.list', [
            'updates' => Updates::latest()->filter(Request(['tag', 'search']))->get()
        ]);
    }

    public function show()
    {
        return view('updates.show');
    }

    public function create()
    {

        return view('updates.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'title' => 'required',
            'tag' => 'required',
            'description' => 'required',
            'cover_photo' => 'required|image',
        ]);

        $update = Updates::create([
            'title' => $request->title,
            'tag_id' => $request->tag,
            'description' => $request->description,
            'cover_photo' => $request->file('cover_photo')->store('images', 'public'),
        ]);

        if ($update) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $update->updateImages()->create([
                        'url' => $image->store('images', 'public')
                    ]);
                }
            }
            return redirect()->back()->with('success', 'The update has been posted!!');
        } else {
            return redirect()->back()->with('error', 'Sending unsuccessful!');
        }

        // $data = array (
        //     'title' => $request->title,
        //     'tag_id' => $request->tag,
        //     'description' => $request->description,
        // );

        // $update = Updates::create($data);

        // if ($request->hasFile('image') ) {
        //     $updateArray['image'] = $request->file('image')->store('images', 'public');
        // }

        // if (!is_null($update)) {
        //     Logs::addToLog('A News/Announcement has been posted | NEWS/ANNOUNCEMENT [' . $update->title . ']');

        //     return response()->json([
        //         'success' => true, 
        //         'message' => 'The update has been posted!!'
        //     ]);

        // } else {
        //     return response()->json([
        //         'success' => false, 
        //         'message' => 'Sending unsuccessful!'
        //     ]);
        // }

    }

    public function edit(Updates $update)
    {
        return view('updates.edit', ['updates' => $update]);
    }

    public function update(Request $request, Updates $update)
    {
        $updateArray = array(
            'title' => $request->title,
            'tag' => $request->tag,
            'description' => $request->description,
        );

        if ($request->hasFile('image')) {
            $updateArray['image'] = $request->file('image')->store('images', 'public');
        }

        $editUpdate = $update->update($updateArray);

        if (!is_null($editUpdate)) {
            Logs::addToLog('An News/Announcement has been updated | NEWS/ANNOUNCEMENT [' . $update->title . ']');
            return response()->json(['success' => true, 'message' => 'Editing successful!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Editing unsuccessful!']);
        }
    }

    public function delete(Updates $update)
    {

        $updateDeleted = $update->delete();

        if ($updateDeleted) {
            return redirect()->back()->with('success', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('eror', 'Something went wrong');
        }
    }
}