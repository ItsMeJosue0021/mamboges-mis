<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function evaluation() {
        return view('evaluation.evaluation', ['students' => Student::all()]);
    }
}
