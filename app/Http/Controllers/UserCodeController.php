<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserCodeController extends Controller
{
    public function index()
    {
        return view('2fa');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $find = UserCode::where('user_id', auth()->id())
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(1))
            ->first();

        if (!is_null($find)) {
            Session::put('user_2fa', auth()->id());

            $userType = auth()->user()->type;

            if ($userType === 'guidance') {
                return redirect()->route('update.list');
            } elseif ($userType === 'faculty') {
                return redirect()->route('faculty.classes');
            } elseif ($userType === 'lr') {
                return redirect()->route('lr.video');
            } else if ($userType === 'student') {
                return redirect()->route('student.portal');
            }
        }

        return back()->with('error', 'You entered wrong code.');
    }

    public function resend()
    {
        auth()->user()->generateCode();

        return back()->with('success', 'We sent you code on your email.');
    }
}
