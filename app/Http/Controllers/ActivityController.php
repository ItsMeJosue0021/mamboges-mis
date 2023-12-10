<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function store(Request $request) {

        $data = request()->validate([
            'name' => 'required',
            'max_score' => 'required',
            'evaluation_criteria_id' => 'required',
        ]);

        $activity = Activity::create([
            'name' => $data['name'],
            'max_score' => $data['max_score'],
            'class_record_evaluation_criteria_id' => $data['evaluation_criteria_id'],
        ]);

        return redirect()->back()->with('success', 'Activity created successfully!');

    }

    public function delete($activityId) {
        $activity = Activity::find($activityId);

        if (!$activity) {
            return redirect()->back()->with('error', 'Activity not found!');
        }
        if (!$activity->delete()) {
            return redirect()->back()->with('error', 'Activity not deleted!');
        }
        return redirect()->back()->with('success', 'Activity deleted successfully!');
    }
}
