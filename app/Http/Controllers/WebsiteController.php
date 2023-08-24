<?php

namespace App\Http\Controllers;

use App\Models\Updates;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index() {
        return view('website.index', [
            'updates' =>  Updates::latest()->paginate(6)
        ]);
    }
}
