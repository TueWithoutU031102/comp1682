<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $request->session()->regenerate();
            if (Auth::user()->role->name === 'Admin') {
                return redirect()->intended(RouteServiceProvider::HOME1);
            } else if (Auth::user()->role->name === 'Manager') {
                return redirect()->intended(RouteServiceProvider::HOME2);
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
