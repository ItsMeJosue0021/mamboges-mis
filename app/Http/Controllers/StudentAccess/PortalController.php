<?php

namespace App\Http\Controllers\StudentAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function portal() {
        return view('student.portal');
    }

    public function account(Request $request) {
        return view('profile.student-profile', [
            'user' => $request->user(),
        ]);
    }
}
