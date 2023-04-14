<?php

namespace App\Http\Controllers;

use App\Models\Updates;
use Illuminate\Http\Request;

class UpdatesController extends Controller
{
    public function index() {
        return view('updates.index', [
            'updates' =>  Updates::latest()->filter(Request(['tag', 'search']))->simplePaginate(9)
        ]);
    }

    public function list() {
        return view('updates.list', [
            'updates' => Updates::latest()->filter(Request(['tag', 'search']))->get()
        ]);
    }

    public function show() {
        return view('updates.show');
    }

    public function create() {
        return view('updates.create');
    }

    public function store(Request $request) {

        $updateArray = array (
            'title' => $request->title,
            'tag' => $request->tag,
            'description' => $request->description,
        );

        if ($request->hasFile('image') ) {
            $updateArray['image'] = $request->file('image')->store('images', 'public');
        }

        $update = Updates::create($updateArray);

        if (!is_null($update)) {
            return response()->json(['success' => true, 'message' => 'The update has been posted!!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Sending unsuccessful!']);
        }
        
    }

    public function edit(Updates $update) {
        return view('updates.edit', ['updates' => $update]);
    }

    public function update(Request $request, Updates $update) {
        $updateArray = array (
            'title' => $request->title,
            'tag' => $request->tag,
            'description' => $request->description,
        );

        if ($request->hasFile('image') ) {
            $updateArray['image'] = $request->file('image')->store('images', 'public');
        }

        $editUpdate = $update->update($updateArray);

        if (!is_null($editUpdate)) {
            return response()->json(['success' => true, 'message' => 'Editing successful!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Editing unsuccessful!']);
        }
    }

    public function delete(Request $request) {

    }
}
