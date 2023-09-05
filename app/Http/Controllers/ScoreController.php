<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\ActivityStatistics;
use App\Models\ClassRecordEvaluationCriteria;

class ScoreController extends Controller
{
    public function store(Request $request) {
        dd($request->all());
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

                $evaluation_criteria = ClassRecordEvaluationCriteria::find($request->criteria_id);
                $activities = $evaluation_criteria->activities;

                $max_score = 0;
                foreach($activities as $activity) {
                    $max_score += $activity->max_score;
                }

                foreach ($studentSums as $studentId => $totalScore) {
                    $student = Student::find($studentId);
                    $statistic = ActivityStatistics::updateOrCreate(
                        ['student_id' => $studentId, 'class_record_evaluation_criteria_id' => $request->criteria_id],
                        ['total' => $totalScore]
                    );

                    $percentage = $evaluation_criteria->percentage;
                    $ps = ($max_score != 0 && $totalScore != 0) ? ($totalScore / $max_score * 100) : 0;
                    $ws = ($ps != 0 && $percentage != 0) ? ($percentage / 100 * $ps) : 0;

                    $statistic->update(['ps' => $ps, 'ws' => $ws]);
                }
                
            }

            return redirect()->back()->with('success', 'Scores saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving scores');
        }

    }
}
