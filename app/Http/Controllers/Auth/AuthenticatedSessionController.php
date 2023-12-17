<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Logs;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\StudentLoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function studentLogin(): View
    {
        return view('auth.student-login');
    }

    public function staffLogin(): View
    {
        return view('auth.staff-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function loginStaff(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $userType = $request->user()->type;

        if ($userType === 'guidance') {
            $url = route('update.list');
        } elseif ($userType === 'faculty') {
            $url = route('faculty.classes');
        } elseif ($userType === 'lr') {
            $url = route('lr.video');
        }

        $request->session()->regenerate();

        auth()->user()->generateCode();

        $request->session()->put('url.intended', $url);
        Logs::addToLog(Auth::user()->username . ' has logged in.');
        return redirect()->intended($url);
    }


    public function loginStudent(StudentLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        auth()->user()->generateCode();

        Logs::addToLog(Auth::user()->username . 'has logged in.');

        return redirect()->intended('/portal/classes');

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Logs::addToLog(Auth::user()->username . 'has logged out.');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('removeActiveLinkId', true);
    }
}
