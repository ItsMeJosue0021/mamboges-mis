<?php

namespace App\Http\Controllers;

use App\Models\ClassRecord;
use Illuminate\Http\Request;
use App\Models\ClassRecordEvaluationCriteria;

class ClassRecordEvaluationCriteriaController extends Controller
{
    public function changePercentage(Request $request, $criteria, $classRecordId)
    {

        $classRecord = ClassRecord::find($classRecordId);
        $class_record_evaluation_criteria = ClassRecordEvaluationCriteria::find($criteria);

        if (!$class_record_evaluation_criteria) {
            return response()->json([
                'message' => 'Evaluation criteria not found!',
                'status' => 'error'
            ]);
        }

        if ($request->percentage == null) {
            return response()->json([
                'message' => 'Percentage cannot be null!',
                'status' => 'error'
            ]);
        }

        $total_percentage = 0;
        foreach($classRecord->classRecordEvaluationCriterias as $criteria) {
            if ($criteria->id != $class_record_evaluation_criteria->id) {
                $total_percentage += $criteria->percentage;
            }
        }
        
        if ($total_percentage + $request->percentage > 100) {
            $class_record_evaluation_criteria->percentage = 100 - $total_percentage;
        } else {
            $class_record_evaluation_criteria->percentage = $request->percentage;
        }
        $class_record_evaluation_criteria->save();



        return response()->json([
            'message' => 'The percentage has been updated!',
            'status' => 'success'
        ]);
    }

    public function getPercentage($criteria)
    {

        $class_record_evaluation_criteria = ClassRecordEvaluationCriteria::find($criteria);

        if (!$class_record_evaluation_criteria) {
            return response()->json([
                'message' => 'Evaluation criteria not found!',
                'status' => 'error'
            ], 404);
        }

        return response()->json([
            'percentage' => $class_record_evaluation_criteria->percentage,
            'status' => 'success'
        ]);
    }
}