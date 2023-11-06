<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            if (Auth::user()->role->name === 'Admin') {
                return redirect()->intended(RouteServiceProvider::HOME1);
            } else if (Auth::user()->role->name === 'Manager') {
                return redirect()->intended(RouteServiceProvider::HOME2);
            }
        } else {
            return view('auth.verify-email');
        }
    }
}
