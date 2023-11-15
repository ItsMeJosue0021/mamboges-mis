<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Subjects;
use App\Models\VideoLesson;
use Illuminate\Http\Request;

class LrController extends Controller
{
    public function videoLesson()
    {
        return view('lr.list-video', [
            'videos' => VideoLesson::latest()->paginate(10),
        ]);
    }

    public function module()
    {
        return view('lr.list-module', [
            'modules' => Module::latest()->paginate(10),
        ]);
    }

}
