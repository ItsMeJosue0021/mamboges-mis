<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function list() {
        return view('tags.list', [
            'tags' => Tag::all()
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'tag' => 'required'
        ]);

        $savedTag = Tag::create([
            'tag' => $request->tag
        ]);

        if ($savedTag) {
            return redirect()->back()->with('success', 'Tag created successfully');
        } else {
            return redirect()->back()->with('error', 'Tag creation failed');
        }
    }

    public function destroy($tagId) {
        $tag = Tag::find($tagId);

        if ($tag) {
            $tag->delete();
            return redirect()->back()->with('success', 'Tag deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Tag deletion failed');
        }
    }


}
