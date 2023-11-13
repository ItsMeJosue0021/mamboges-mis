<?php

namespace App\Http\Controllers;

use App\Models\Updates;
use App\Models\Achievement;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index() {
        return view('welcome', [
            'updates' =>  Updates::latest()->take(3)->get(),
            'first_update' => Updates::latest()->first(),
            'achievements' => Achievement::latest()->take(3)->get(),
            'first_achievement' => Achievement::latest()->first(),
        ]);
    }
}
