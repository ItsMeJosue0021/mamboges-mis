<?php

namespace App\Http\Controllers;

use App\Models\Updates;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index() {
        return view('welcome', [
            'updates' =>  Updates::latest()->take(3)->get(),
            'first_update' => Updates::latest()->first(),
        ]);
    }
}
