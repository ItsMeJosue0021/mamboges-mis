<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\ActivityStatistics;

class ScoreController extends Controller
{
    public function store(Request $request) {
        // dd($request->all());
        try {
            $scores = $request->input('scores');
            $studentSums = []; 

            foreach ($scores as $studentId => $activityScores) {
                $studentSum = 0;
                foreach ($activityScores as $activityId => $score) {
                    $score = ($score !== null) ? $score : 0;

                    $existingScore = Score::where('student_id', $studentId)
                    ->where('activity_id', $activityId)
                    ->first();

                    if ($existingScore) {
                        $existingScore->score = $score;
                        $existingScore->save();
                    } else {
                        $newScore = new Score([
                            'student_id' => $studentId,
                            'activity_id' => $activityId,
                            'score' => $score,
                        ]);
                        $newScore->save();
                    }
                    $studentSum += $score;
                }
                $studentSums[$studentId] = $studentSum;

                foreach ($studentSums as $studentId => $totalScore) {
                    // Find or create a record in the 'statistics' table based on student and evaluation criteria
                    $statistic = ActivityStatistics::updateOrCreate(
                        ['student_id' => $studentId, 'class_record_evaluation_criteria_id' => $request->criteria_id],
                        ['total' => $totalScore]
                    );
                
                    // You can also update 'ps' and 'ws' columns if needed
                    // $statistic->update(['ps' => $psScore, 'ws' => $wsScore]);
                }
                
            }

            return redirect()->back()->with('success', 'Scores saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving scores');
        }

    }
}
