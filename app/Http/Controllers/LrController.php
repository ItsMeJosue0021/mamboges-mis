<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LrController extends Controller
{
    public function videoLesson() {
        return view('lr.video');
    }

    public function module() {
        return view('lr.module');
    }

}
