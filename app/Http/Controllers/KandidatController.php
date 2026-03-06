<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KandidatController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        // Ambil relasi hasOne sebagai model tunggal (bisa null jika belum ada data)
        $kompetensi = $user->kandidatKompetensi ?? null;

        return view('kandidat.dashboard', compact('user', 'kompetensi'));
    }
}