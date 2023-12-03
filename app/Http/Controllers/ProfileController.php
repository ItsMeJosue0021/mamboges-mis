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
    public function guidance(Request $request) {
        return view('profile.guidance-profile', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request) {
        $user = Auth::user();

        $request ->validate([
            'image' => 'nullable',
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'nullable',
            'suffix' => 'nullable',
            'sex' => 'required|in:Male,Female',
            'contactNumber' => 'nullable',
            'dob' => 'required|date',
        ]);

        $profileUpdated = $user->profile->update([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'suffix' => $request->suffix,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'contactNumber' => $request->contactNumber,
            'image' => $request->hasFile('image') ? $request->file('image')->store('profile', 'public') : $user->profile->image,
        ]);

        if (!$profileUpdated) {
            return redirect()->back()->with('error','Unable to update profile.');
        }

        return redirect()->back()->with('success','Profile updated successfully.');
    }

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
