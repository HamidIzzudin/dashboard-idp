<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil kandidat (gambar 3)
     */
    public function show(Request $request): View
    {
        $user = $request->user()->load(['mentor', 'atasan']);
        return view('profile.dashboard', compact('user'));
    }

    /**
     * Tampilkan form edit profil
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update profil user
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        // Handle upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-profil', 'public');
        }

        // Hapus key foto dari data jika tidak ada upload (agar tidak menimpa nilai lama)
        if (!isset($data['foto'])) {
            unset($data['foto']);
        }

        $user->fill($data)->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun user
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}