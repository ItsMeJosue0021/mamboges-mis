<?php

namespace App\Http\Controllers;

use App\Models\Updates;
use App\Models\Achievement;
use App\Models\OrgChartRow;

class WebsiteController extends Controller
{
    public function index() {
        return view('welcome', [
            'updates' =>  Updates::latest()->take(3)->get(),
            'first_update' => Updates::latest()->first(),
            'achievements' => Achievement::latest()->take(3)->get(),
            'first_achievement' => Achievement::latest()->first(),
            'rows' => OrgChartRow::orderBy('order')->get(),
        ]);
    }

    
}
