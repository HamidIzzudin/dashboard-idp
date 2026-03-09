<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\IdpActivity;
use App\Models\KandidatKompetensi;
use App\Models\User;

class KandidatDashboardController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            Log::info('KandidatDashboard accessed by user: ' . $user->id . ' (' . $user->username . ')');
            
            // Hanya kandidat yang bisa akses dashboard ini
            if ($user->role !== 'kandidat') {
                Log::warning('Non-kandidat user ' . $user->username . ' tried to access kandidat dashboard');
                abort(403, 'Hanya kandidat yang bisa mengakses dashboard ini.');
            }
            
            // Fetch kompetensi dari tabel kandidat_kompetensi
            $kompetensi = $user->kandidatKompetensi ?? null;
            
            if (!$kompetensi) {
                Log::warning('User ' . $user->username . ' has no competency data');
            }
            
            // Return ke view dengan data
            $notifications = $this->getNotifications();
            $competenciesList = DB::table('competencies')->pluck('name')->toArray();

            return view('kandidat.dashboard', compact('user', 'kompetensi', 'notifications', 'competenciesList'));
        } catch (\Exception $e) {
            Log::error('KandidatDashboard error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function idpMonitoring($tab = 'exposure')
    {
        try {
            $user = Auth::user();
            
            if ($user->role !== 'kandidat') {
                abort(403, 'Hanya kandidat yang bisa mengakses halaman ini.');
            }

            // Get mentors and atasans for the dropdown list
            $mentors = User::whereIn('role', ['mentor'])->get();
            $atasans = User::whereIn('role', ['atasan'])->get();
            
            // For the Exposure tab which says "Mentor / Atasan"
            $mentorAtasanList = User::whereIn('role', ['mentor', 'atasan'])->get();

            return view('kandidat.idp-monitoring', compact('user', 'tab', 'mentors', 'atasans', 'mentorAtasanList'));
        } catch (\Exception $e) {
            Log::error('KandidatDashboard idpMonitoring error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function storeIdpMonitoring(Request $request, $tab = 'exposure')
    {
        try {
            $user = Auth::user();
            if ($user->role !== 'kandidat') {
                abort(403, 'Hanya kandidat yang bisa mengakses halaman ini.');
            }

            // Find IDP Type ID
            $typeId = DB::table('idp_type')->where('type_name', ucfirst($tab))->value('id');
            if (!$typeId) {
                return back()->with('error', 'Tipe IDP tidak valid.');
            }

            $documentPath = '';
            $fileName = null;
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $fileName = $file->getClientOriginalName();
                $documentPath = $file->store('idp_documents', 'public');
            }

            $verifyById = null;
            if ($request->filled('mentor_name')) {
                $verifyById = User::where('nama', $request->mentor_name)->value('id');
            }

            IdpActivity::create([
                'user_id_talent' => $user->id,
                'type_idp' => $typeId,
                'verify_by' => $verifyById,
                'theme' => $request->theme ?? '',
                'activity_date' => $request->activity_date,
                'location' => $request->location ?? '',
                'activity' => $request->activity ?? '',
                'description' => $request->description ?? '',
                'action_plan' => $request->action_plan ?? '',
                'document_path' => $documentPath,
                'file_name' => $fileName,
                'status' => 'Pending',
                'platform' => $request->platform ?? '',
            ]);

            return redirect()->route('kandidat.dashboard')->with('success', 'IDP Activity berhasil disubmit.');
        } catch (\Exception $e) {
            Log::error('KandidatDashboard storeIdpMonitoring error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function notifikasi()
    {
        try {
            $user = Auth::user();
            
            if ($user->role !== 'kandidat') {
                abort(403, 'Hanya kandidat yang bisa mengakses halaman ini.');
            }

            $notifications = $this->getNotifications();
            return view('kandidat.notifikasi', compact('user', 'notifications'));
        } catch (\Exception $e) {
            Log::error('KandidatDashboard notifikasi error: ' . $e->getMessage());
            throw $e;
        }
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
