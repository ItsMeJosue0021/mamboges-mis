<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRecordEvaluationCriteria;

class ClassRecordEvaluationCriteriaController extends Controller
{
    public function changePercentage(Request $request, $criteria) {
        
        $class_record_evaluation_criteria = ClassRecordEvaluationCriteria::find($criteria);

        if (!$class_record_evaluation_criteria) {
            return response()->json([
                'error' => 'Evaluation criteria not found!',
                'status' => 'error'
            ], 404);
        }

        $class_record_evaluation_criteria->percentage = $request->percentage;
        $class_record_evaluation_criteria->save();
        
        return response()->json([
            'message' => 'The percentage has been updated!',
            'status' => 'success'
        ]);
    }

    public function getPercentage($criteria) {
        
        $class_record_evaluation_criteria = ClassRecordEvaluationCriteria::find($criteria);
            
        if (!$class_record_evaluation_criteria) {
            return response()->json([
                'error' => 'Evaluation criteria not found!',
                'status' => 'error'
            ], 404);
        }

        return response()->json([
            'percentage' => $class_record_evaluation_criteria->percentage,
            'status' => 'success'
        ]);
    }
}
