<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index() {
        return view('classes.index');
    }

    public function evaluation() {
        return view('evaluation.evaluation', [
            'students' => Student::all()
        ]);
    }
}
