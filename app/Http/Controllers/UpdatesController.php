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
            'updates' => Updates::latest()->filter(Request(['tag', 'search']))->paginate(9)
        ]);
    }

    public function list()
    {
        return view('updates.list', [
            'updates' => Updates::filter(Request(['tag', 'search']))
                ->orderBy('updates.created_at', 'desc')
                ->simplePaginate(9)
        ]);

    }

    public function show(Updates $update)
    {
        return view('updates.show', ['update' => $update]);
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
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $update = Updates::create([
            'title' => $request->title,
            'tag_id' => $request->tag,
            'description' => $request->description,
            'cover_photo' => $request->file('cover_photo')->store('updates', 'public'),
        ]);

        if ($update) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $update->updateImages()->create([
                        'url' => $image->store('updates', 'public')
                    ]);
                }
            }
            return redirect()->back()->with('success', 'The update has been posted!!');
        } else {
            return redirect()->back()->with('error', 'Sending unsuccessful!');
        }

    }

    public function edit(Updates $update)
    {
        return view('updates.edit', [
            'update' => $update,
            'tags' => Tag::all()
        ]);
    }

    public function getImages(Request $request) {

        $update = Updates::find($request->updateId);
        $updateImages = $update->updateImages;

        $images = [];

        foreach($updateImages as $updateImage) {
            $images[] = [
                'id' => $updateImage->id,
                'fileName' => $updateImage->url,
            ];
        }
        return response()->json($images);
    }

    public function update(Request $request, Updates $update)
    {
        // dd($request->all());

        $this->validate($request, [
            'title' => 'required',
            'tag' => 'required',
            'description' => 'required',
        ]);

        $update->update([
            'title' => $request->title,
            'tag_id' => $request->tag,
            'description' => $request->description,
        ]);

        if ($request->hasFile('cover_photo')) {
            $update->update([
                'cover_photo' => $request->file('cover_photo')->store('images', 'public'),
            ]);
        } else {
            $update->update([
                'cover_photo' => $update->cover_photo,
            ]);
        }

        if ($update) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $update->updateImages()->create([
                        'url' => $image->store('images', 'public')
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Sending unsuccessful');
        }
    }

    public function delete(Updates $update)
    {

        $updateDeleted = $update->delete();

        if ($updateDeleted) {

            foreach($update->updateImages as $image) {
                $image->delete();
            }

            return redirect()->back()->with('success', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function deleteImage(Updates $update, $id)
    {
        $image = $update->updateImages()->where('id', $id)->first();

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        $imageDeleted = $image->delete();

        if ($imageDeleted) {
            return response()->json(['message' => 'Image deleted successfully']);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

}
