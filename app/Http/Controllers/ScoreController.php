<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store(Request $request) {
        // dd($request->all());
        try {
            $scores = $request->input('scores');

            foreach ($scores as $studentId => $activityScores) {
                foreach ($activityScores as $activityId => $score) {
                    $existingScore = Score::where('student_id', $studentId)
                    ->where('activity_id', $activityId)
                    ->first();

                    if ($existingScore) {
                        $existingScore->score = $score;
                        $existingScore->save();
                    } else {
                        $score = new Score([
                            'student_id' => $studentId,
                            'activity_id' => $activityId,
                            'score' => $score,
                        ]);
                        $score->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Scores saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving scores');
        }

    }
}
