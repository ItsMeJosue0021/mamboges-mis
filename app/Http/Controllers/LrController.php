<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LrController extends Controller
{
    public function index() {
        return view('lr.dashboard');
    }
}
