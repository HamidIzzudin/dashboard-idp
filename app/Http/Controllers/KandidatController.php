<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KandidatController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        // Ambil relasi hasOne sebagai model tunggal (bisa null jika belum ada data)
        $kompetensi = $user->kandidatKompetensi ?? null;

        $competenciesList = DB::table('competencies')->pluck('name')->toArray();

        $notifications = $this->getNotifications();

        return view('kandidat.dashboard', compact('user', 'kompetensi', 'competenciesList', 'notifications'));
    }

    public function notifikasi()
    {
        $user = auth()->user();
        $notifications = $this->getNotifications();
        return view('kandidat.notifikasi', compact('user', 'notifications'));
    }

    private function getNotifications()
    {
        return collect([
            [
                'id' => 1,
                'title' => 'Submit IDP Berhasil',
                'desc' => 'Formulir <span class="font-semibold">Exposure</span> Anda telah berhasil dikirim dan sedang menunggu tinjauan dari mentor/atasan.',
                'type' => 'success', // success, info, warning
                'time' => '10 menit yang lalu',
                'is_read' => false,
                'badge' => 'Baru'
            ],
            [
                'id' => 2,
                'title' => 'Review Mentor Selesai',
                'desc' => 'Project Improvement Anda berjudul <span class="font-semibold">"Sistem Logistik Baru"</span> telah direview oleh mentor Anda. Klik untuk melihat feedback.',
                'type' => 'info',
                'time' => '2 jam yang lalu',
                'is_read' => true,
                'badge' => null
            ],
            [
                'id' => 3,
                'title' => 'Pengingat LogBook',
                'desc' => 'Anda belum mengisi LogBook untuk aktivitas <span class="font-semibold">Mentoring</span> minggu ini. Pastikan untuk memperbaruinya segera.',
                'type' => 'warning',
                'time' => 'Kemarin, 14:30',
                'is_read' => true,
                'badge' => null
            ],
            [
                'id' => 4,
                'title' => 'Pembaruan Kompetensi',
                'desc' => 'Atasan Anda telah memberikan penilaian kompetensi terbaru untuk Anda. Periksa grafik pada dashboard.',
                'type' => 'success',
                'time' => '3 hari yang lalu',
                'is_read' => true,
                'badge' => null
            ]
        ]);
    }
}