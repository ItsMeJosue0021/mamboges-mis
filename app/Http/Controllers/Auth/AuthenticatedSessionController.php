<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
