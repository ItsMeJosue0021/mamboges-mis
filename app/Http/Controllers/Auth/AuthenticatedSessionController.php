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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url = '';
        switch ($request->user()->type) {
            case 'guidance':
                $url = '/students';
                break;
            case 'student':
                $url = '/student/dashboard';
                break;
            case 'faculty':
                $url = '/classes';
                break;
            case 'lr':
                $url = '/lr/dashboard';
                break;
            default:
                $url = '/';
        }
        
        $request->session()->put('url.intended', $url);

        Logs::addToLog(Auth::user()->username . 'has logged in.');

        return redirect()->intended($url);
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

        return redirect('/');
    }
}
