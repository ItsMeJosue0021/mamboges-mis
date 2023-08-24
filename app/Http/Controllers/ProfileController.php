<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // dd($request->all());
        $id = Auth::user()->id;

        $userType = Auth::user()->type;

        $user = User::where('id', $id)->first();

        $userInfo = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($user->type == 'guidance' || $user->type == 'faculty') {
            $userInfo['username'] = $request->email;
        }

        if ($request->hasFile('image') ) {
            $userInfo['image'] = $request->file('image')->store('profile', 'public');
        }

        if ($userType == 'student') {

            $student = Student::where('lrn', Auth::user()->username)->first();

            if ($request->hasFile('image') ) {
                $student->image = $request->file('image')->store('profile', 'public');
            }

            $student->save();
        }

        if ($userType == 'faculty') {

            $faculty = Faculty::where('email', Auth::user()->username)->first();

            if ($request->hasFile('image') ) {
                $faculty->image = $request->file('image')->store('profile', 'public');
            }

            $faculty->save();
        }


        $user->update($userInfo);

        if (Auth::user()->type == 'student') {
            return Redirect::route('student.profile')->with('status', 'profile-updated');
        } else {
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->status = 'inactive';

        // $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
