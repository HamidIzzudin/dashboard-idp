<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
        ]);

        // Cari user berdasarkan username atau email
        $login = $request->input('login');
        $user = User::where('email', $login)
                    ->orWhere('username', $login)
                    ->first();

        if (! $user) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors(['login' => 'Username atau email tidak ditemukan.']);
        }

        $status = Password::sendResetLink(['email' => $user->email]);

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('login'))
                        ->withErrors(['login' => __($status)]);
    }
}
