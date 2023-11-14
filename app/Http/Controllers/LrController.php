<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Subjects;
use Illuminate\Http\Request;

class LrController extends Controller
{
    public function videoLesson()
    {
        return view('lr.video', [
            'subjects' => Subjects::all(),
        ]);
    }

    public function module()
    {
        return view('lr.module', [
            'subjects' => Subjects::all(),
            'modules' => Module::all(),
        ]);
    }

}
