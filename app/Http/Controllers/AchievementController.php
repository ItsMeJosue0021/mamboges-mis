<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{

    public function index()
    {
        return view('achievements.index', [
            'achievements' => Achievement::latest()->simplePaginate(9)
        ]);
    }

    public function create()
    {
        return view('achievements.create');
    }

    public function list() 
    {
        return view('achievements.list', [
            'achievements' => Achievement::latest()->simplePaginate(9)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'coverPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $achievement = Achievement::create([
            'title' => $request->title,
            'description' => $request->description,
            'coverPhoto' => $request->file('coverPhoto')->store('achievements', 'public'),
        ]);

        if ($achievement) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $achievement->achievementImages()->create([
                        'fileName' => $image->store('achievements', 'public')
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Achievement created successfully.');
        } else {
            return redirect()->back()->with('error', 'Saving unsuccessfully. Please try again.');
        }

    }

    public function show(Achievement $achievement)
    {
        return view('achievements.show', [
            'achievement' => $achievement
        ]);
    }

    public function edit(Achievement $achievement)
    {
        return view('achievements.edit', [
            'achievement' => $achievement
        ]);
    }

    public function getImages(Request $request) {

        $achievement = Achievement::find($request->achievementId);
        $achievementImages = $achievement->achievementImages;

        $images = [];

        foreach($achievementImages as $achievementImage) {
            $images[] = [
                'id' => $achievementImage->id,
                'fileName' => $achievementImage->fileName,
            ];
        }
        return response()->json($images);
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $achievement->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->hasFile('coverPhoto')) {
            $achievement->update([
                'coverPhoto' => $request->file('coverPhoto')->store('achievements', 'public'),
            ]);
        } else {
            $achievement->update([
                'coverPhoto' => $achievement->coverPhoto,
            ]);
        }

        if ($achievement) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $achievement->achievementImages()->create([
                        'fileName' => $image->store('achievements', 'public')
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Achievement updated successfully');
        } else {
            return redirect()->back()->with('error', 'Saving unsuccessfully. Please try again');
        }
    }

    public function delete(Achievement $achievement)
    {
        $updateAchievement = $achievement->delete();

        if ($updateAchievement) {

            foreach($achievement->achievementImages as $achievementImage) {
                $achievementImage->delete();
            }

            return redirect()->back()->with('success', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}