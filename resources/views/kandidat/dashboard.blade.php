<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Talent – Individual Development Plan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 99px;
        }

        /* ── Donut Chart ── */
        .donut-ring {
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        /* ── Smooth entrance ── */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeSlideUp 0.5s ease both;
        }

        .fade-up-1 {
            animation-delay: 0.05s;
        }

        .fade-up-2 {
            animation-delay: 0.12s;
        }

        .fade-up-3 {
            animation-delay: 0.20s;
        }

        .fade-up-4 {
            animation-delay: 0.28s;
        }

        /* ── Competency bar ── */
        @keyframes barReveal {
            from {
                clip-path: inset(0 100% 0 0);
            }

            to {
                clip-path: inset(0 0% 0 0);
            }
        }

        .bar-fill {
            animation: barReveal 0.9s cubic-bezier(0.4, 0, 0.2, 1) both;
            animation-delay: 0.35s;
        }

        /* ── Dropdown custom ── */
        .score-select {
            -webkit-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.5' stroke='%234a5a6a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 14px;
            padding: 0.4rem 2rem 0.4rem 0.75rem;
            min-width: 64px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: #3d4f62;
            background-color: #f8fafc;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .score-select:focus {
            outline: none;
            border-color: #3d4f62;
            box-shadow: 0 0 0 3px rgba(61, 79, 98, 0.12);
        }

        .score-select:hover {
            border-color: #94a3b8;
            background-color: #fff;
        }

        /* ── Upload area ── */
        .upload-area {
            border: 2px dashed #cbd5e1;
            transition: border-color 0.2s, background 0.2s;
        }

        .upload-area:hover,
        .upload-area.drag-over {
            border-color: #22c55e;
            background: #f0fdf4;
        }

        /* ── Navbar outer wrapper ── */
        .navbar-outer {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            width: 100%;
            display: flex;
            align-items: center;
            background: #3d4f62;
            padding: 1rem 1.75rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-outer.nav-hidden {
            transform: translateY(-110%);
        }

        /* ── Navbar notification badge ── */
        .notif-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            width: 9px;
            height: 9px;
            background: #ef4444;
            border-radius: 50%;
            border: 1.5px solid white;
        }

        /* ── Icon buttons (bell & user) ── */
        .nav-icon-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background: white;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
            color: #3d4f62;
            cursor: pointer;
            transition: box-shadow 0.2s, transform 0.15s;
            position: relative;
        }

        .nav-icon-btn:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.22);
            transform: translateY(-1px);
        }

        /* ── Page Background ── */
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col pt-[80px]">

    {{-- ══════════════════════════════ NAVBAR ══════════════════════════════ --}}
    <div class="navbar-outer">

        {{-- Brand --}}
        <div class="flex items-center gap-4 flex-shrink-0">
            <div class="bg-white p-2 rounded-xl shadow-sm flex items-center justify-center w-14 h-14">
                <img src="{{ asset('asset/logo ts.png') }}" alt="Logo TS" class="w-full h-full object-contain">
            </div>
            <h1 class="text-white text-xl font-bold tracking-wide whitespace-nowrap">
                Individual Development Plan
            </h1>
        </div>

        {{-- Nav links --}}
        <div class="flex items-center space-x-14 text-white text-sm font-medium ml-auto pr-6">
            <a href="#Kompetensi" class="hover:text-blue-200 transition-colors duration-150">Kompetensi</a>
            <a href="#IDP Monitoring" class="hover:text-blue-200 transition-colors duration-150">IDP</a>
            <a href="#Project Improvement" class="hover:text-blue-200 transition-colors duration-150">Project
                Improvement</a>
            <a href="#LogBook" class="hover:text-blue-200 transition-colors duration-150">LogBook</a>
        </div>

        {{-- Ikon (Kanan) --}}
        <div class="flex items-center space-x-3 pl-4 border-l border-white/20">
            {{-- Bell --}}
            <button class="nav-icon-btn" aria-label="Notifikasi">
                <span class="notif-badge"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6z" />
                    <path d="M10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
            </button>
            {{-- Profile --}}
            <button class="nav-icon-btn" aria-label="Profil">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>

    </div>

    {{-- ══════════════════════════════ PROFILE CARD ══════════════════════════════ --}}
    <div class="bg-[#3d4f62] shadow-md py-6 fade-up fade-up-1">
        <div class="flex items-stretch divide-x divide-white/20">

            {{-- Bagian 1: Avatar + Nama + Role --}}
            <div class="flex items-center gap-5 px-10 flex-shrink-0 w-1/3 justify-center py-2">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    @if ($user->foto ?? false)
                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil"
                            class="w-24 h-24 rounded-xl object-cover border-2 border-white/30">
                    @else
                        <div
                            class="w-24 h-24 rounded-xl bg-white/20 flex items-center justify-center border-2 border-white/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white/70" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div>
                    <p class="text-white font-bold text-base leading-tight">{{ $user->nama ?? $user->name }}</p>
                    <p class="text-white/60 text-xs mt-1">
                        {{ $user->role === 'kandidat' ? 'Talent' : ucfirst($user->role) }}</p>
                </div>
            </div>

            {{-- Bagian 2: Perusahaan, Departemen, Jabatan yang Dituju --}}
            <div class="px-10 w-1/3 flex flex-col pt-3 space-y-3 text-sm">
                <div class="flex gap-2">
                    <span class="font-semibold text-white/70 w-32 flex-shrink-0">Perusahaan</span>
                    <span class="text-white">{{ $user->perusahaan ?? '-' }}</span>
                </div>
                <div class="flex gap-2">
                    <span class="font-semibold text-white/70 w-32 flex-shrink-0">Departemen</span>
                    <span class="text-white">{{ $user->departemen ?? '-' }}</span>
                </div>
                <div class="flex gap-2">
                    <span class="font-semibold text-white/70 w-32 flex-shrink-0">Jabatan yang Dituju</span>
                    <span class="text-white">{{ $user->jabatan_target ?? '-' }}</span>
                </div>
            </div>

            {{-- Bagian 3: Mentor, Atasan --}}
            <div class="px-10 w-1/3 flex flex-col pt-3 space-y-3 text-sm">
                <div class="flex gap-2">
                    <span class="font-semibold text-white/70 w-20 flex-shrink-0">Mentor</span>
                    <span class="text-white">{{ $user->mentor->nama ?? '-' }}</span>
                </div>
                <div class="flex gap-2">
                    <span class="font-semibold text-white/70 w-20 flex-shrink-0">Atasan</span>
                    <span class="text-white">{{ $user->atasan->nama ?? '-' }}</span>
                </div>
            </div>

        </div>
    </div>

    <div class="w-full px-6 pt-5 pb-6 space-y-6 flex-grow">

        {{-- ══════════════════════════════ CHART ROW ══════════════════════════════ --}}
        <div class="space-y-1" id="Kompetensi">
            <div class="flex items-center gap-2.5 px-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#4a5a6a]" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <h2 class="text-xl font-bold text-[#4a5a6a]">Kompetensi</h2>
            </div>

            {{-- ── Kompetensi Bar Chart (full width) ── --}}
            <div class="bg-gray-50 border border-gray-100 rounded-2xl shadow-sm p-6 fade-up fade-up-2">
                @php
                    $kompetensiBars = [
                        'Integrity' => $kompetensi->integrity ?? 3,
                        'Communication' => $kompetensi->communication ?? 4,
                        'Innovation & Creativity' => $kompetensi->innovation_creativity ?? 3,
                        'Customer Orientation' => $kompetensi->customer_orientation ?? 2,
                        'Teamwork' => $kompetensi->teamwork ?? 4,
                        'Leadership' => $kompetensi->leadership ?? 3,
                        'Business Acumen' => $kompetensi->business_acumen ?? 3,
                        'Problem Solving & Decision Making' => $kompetensi->problem_solving ?? 2,
                        'Achievement Orientation' => $kompetensi->achievement_orientation ?? 3,
                        'Strategic Thinking' => $kompetensi->strategic_thinking ?? 2,
                    ];
                    $maxScore = 5;
                @endphp
                <div class="space-y-5">
                    @foreach ($kompetensiBars as $label => $score)
                        @php
                            $pct = (($score - 1) / ($maxScore - 1)) * 100;
                        @endphp
                        <div class="flex items-center gap-3">
                            <span
                                class="text-sm text-gray-700 w-52 flex-shrink-0 whitespace-nowrap overflow-hidden truncate"
                                title="{{ $label }}">{{ $label }}</span>
                            <div class="flex-1 bg-gray-100 rounded-full h-5 overflow-hidden">
                                <div class="bar-fill h-full rounded-full"
                                    style="width:{{ $pct }}%; background:#0d9488;"></div>
                            </div>
                            <span class="text-sm font-bold w-6 text-right flex-shrink-0"
                                style="color:#0d9488;">{{ $score }}</span>
                        </div>
                    @endforeach
                    {{-- Skala keterangan -- sejajar dengan bar --}}
                    <div class="flex items-center gap-3 pt-1">
                        <span class="w-52 flex-shrink-0"></span>
                        <div class="flex-1 flex justify-between text-xs text-gray-400">
                            <span>1</span>
                            <span>2</span>
                            <span>3</span>
                            <span>4</span>
                            <span>5</span>
                        </div>
                        <span class="w-6 flex-shrink-0"></span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ══════════════════════════════ IDP MONITORING CARDS ══════════════════════════════ --}}
        <div class="space-y-1" id="IDP Monitoring">
            <div class="flex items-center gap-2.5 px-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#4a5a6a]" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                </svg>
                <h2 class="text-xl font-bold text-[#4a5a6a]">IDP Monitoring</h2>
            </div>

            <div class="bg-gray-50 rounded-2xl shadow-sm p-6 border border-gray-200 fade-up fade-up-4">

                {{-- Smooth Progress Circle Charts --}}
                @php
                    $idpChartData = [
                        'Exposure' => [
                            'done' => 4,
                            'total' => 6,
                            'from' => '#ea580c',
                            'to' => '#fbbf24',
                            'id' => 'grad-exposure',
                        ],
                        'Learning' => [
                            'done' => 5,
                            'total' => 6,
                            'from' => '#c2410c',
                            'to' => '#fb923c',
                            'id' => 'grad-learning',
                        ],
                        'Mentoring' => [
                            'done' => 6,
                            'total' => 6,
                            'from' => '#7c2d12',
                            'to' => '#ea580c',
                            'id' => 'grad-mentoring',
                        ],
                    ];
                    $r = 38;
                    $circ = 2 * M_PI * $r; // ≈ 238.76
                @endphp
                <div class="flex justify-evenly gap-6 flex-wrap mb-8 pb-6 border-b border-gray-200">
                    @foreach ($idpChartData as $label => $d)
                        @php
                            $pct = $d['done'] / $d['total'];
                            $filled = $pct * $circ;
                            $empty = $circ - $filled;
                        @endphp
                        <div class="flex flex-col items-center gap-3">
                            <div class="relative w-48 h-48 drop-shadow-sm">
                                <svg viewBox="0 0 100 100" class="w-full h-full -rotate-90">
                                    {{-- Gradient definition --}}
                                    <defs>
                                        <linearGradient id="{{ $d['id'] }}" x1="0%" y1="0%"
                                            x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="{{ $d['from'] }}" />
                                            <stop offset="100%" stop-color="{{ $d['to'] }}" />
                                        </linearGradient>
                                    </defs>
                                    {{-- Track (background ring) --}}
                                    <circle cx="50" cy="50" r="{{ $r }}" fill="none"
                                        stroke="#f1f5f9" stroke-width="10" />
                                    {{-- Progress arc --}}
                                    <circle cx="50" cy="50" r="{{ $r }}" fill="none"
                                        stroke="url(#{{ $d['id'] }})" stroke-width="10" stroke-linecap="round"
                                        stroke-dasharray="{{ number_format($filled, 2) }} {{ number_format($empty, 2) }}"
                                        style="transition: stroke-dasharray 0.8s ease;" />
                                </svg>
                                {{-- Center text --}}
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-4xl font-bold"
                                        style="color:{{ $d['from'] }};">{{ round($pct * 100) }}%</span>
                                </div>
                            </div>
                            <div class="bg-white border border-gray-200 px-5 py-1.5 rounded-xl shadow-sm">
                                <span class="text-sm font-bold text-gray-800">{{ $label }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Exposure --}}
                    <div
                        class="bg-white shadow-sm border border-gray-100 rounded-xl p-5 flex flex-col justify-between">
                        <div class="flex flex-col h-full">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </span>
                                <h3 class="text-base font-bold text-gray-800">Exposure</h3>
                            </div>
                            <p class="text-sm text-teal-600 font-semibold mb-1">Exposure / Assignment</p>
                            <p class="text-sm text-gray-600 mb-1 font-medium">Contoh kegiatan:</p>
                            <ul class="text-sm text-gray-600 space-y-0.5 list-disc list-inside mb-3">
                                <li>Meeting</li>
                                <li>Shadowing</li>
                                <li>Acting</li>
                                <li>Project</li>
                            </ul>
                            <p class="text-sm text-teal-600 font-bold text-right mt-auto">Bobot : 70%</p>
                        </div>
                        <button
                            class="mt-4 w-full bg-amber-400 hover:bg-amber-500 text-white text-sm font-semibold py-2 rounded-lg transition active:scale-95">
                            Next
                        </button>
                    </div>

                    {{-- Mentoring --}}
                    <div
                        class="bg-white shadow-sm border border-gray-100 rounded-xl p-5 flex flex-col justify-between">
                        <div class="flex flex-col h-full">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </span>
                                <h3 class="text-base font-bold text-gray-800">Mentoring</h3>
                            </div>
                            <p class="text-sm text-teal-600 font-semibold mb-1">Mentoring / Coaching</p>
                            <p class="text-sm text-gray-600 mb-1 font-medium">Contoh kegiatan:</p>
                            <ul class="text-sm text-gray-600 space-y-0.5 list-disc list-inside mb-3">
                                <li>Penjadwalan</li>
                                <li>Catatan singkat</li>
                                <li>Action plan</li>
                            </ul>
                            <p class="text-sm text-teal-600 font-bold text-right mt-auto">Bobot : 20%</p>
                        </div>
                        <button
                            class="mt-4 w-full bg-amber-400 hover:bg-amber-500 text-white text-sm font-semibold py-2 rounded-lg transition active:scale-95">
                            Next
                        </button>
                    </div>

                    {{-- Learning --}}
                    <div
                        class="bg-white shadow-sm border border-gray-100 rounded-xl p-5 flex flex-col justify-between">
                        <div class="flex flex-col h-full">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </span>
                                <h3 class="text-base font-bold text-gray-800">Learning</h3>
                            </div>
                            <p class="text-sm text-teal-600 font-semibold mb-1">Learning</p>
                            <p class="text-sm text-gray-600 mb-1 font-medium">Contoh kegiatan:</p>
                            <ul class="text-sm text-gray-600 space-y-0.5 list-disc list-inside mb-3">
                                <li>LMS Internal</li>
                                <li>Youtube edukatif</li>
                                <li>Artikel</li>
                                <li>Online course</li>
                            </ul>
                            <p class="text-sm text-teal-600 font-bold text-right mt-auto">Bobot : 10%</p>
                        </div>
                        <button
                            class="mt-4 w-full bg-amber-400 hover:bg-amber-500 text-white text-sm font-semibold py-2 rounded-lg transition active:scale-95">
                            Next
                        </button>
                    </div>

                </div>
            </div>
        </div> {{-- /wrapper IDP Monitoring cards --}}

        {{-- ══════════════════════════════ PROJECT IMPROVEMENT ══════════════════════════════ --}}
        <div class="space-y-1">
            <div class="flex items-center gap-2.5 px-2" id="Project Improvement">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#4a5a6a]" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                </svg>
                <h2 class="text-xl font-bold text-[#4a5a6a]">Project Improvement</h2>
            </div>

            <div class="bg-gray-50 rounded-2xl shadow-sm p-6 border border-gray-200 fade-up fade-up-4">

                {{-- Download Template --}}
                <div class="flex justify-start mb-5">
                    <a href="#"
                        class="flex items-center gap-2 text-sm font-semibold text-gray-600 border border-gray-300 bg-white hover:bg-gray-100 px-4 py-2 rounded-lg transition shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Template
                    </a>
                </div>

                <p class="text-xs text-gray-500 mb-2">Unggah projek anda disini</p>

                {{-- Upload Area --}}
                <form action="#" method="POST" enctype="multipart/form-data" id="upload-form">
                    @csrf
                    <label for="file-upload"
                        class="upload-area rounded-xl cursor-pointer flex flex-col items-center justify-center py-10 mb-4"
                        id="drop-zone">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-gray-400 mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        <span class="text-sm text-gray-500">Klik untuk mengunggah</span>
                        <input id="file-upload" name="project_file" type="file" class="sr-only">
                    </label>

                    {{-- Project Table --}}
                    <div class="overflow-hidden rounded-xl border border-gray-200 mb-5">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th
                                        class="text-center px-4 py-3 font-semibold text-gray-700 border-b border-r border-gray-200">
                                        Judul Project Improvement</th>
                                    <th class="border-b border-r border-gray-200 w-12"></th>
                                    <th
                                        class="text-center px-4 py-3 font-semibold text-gray-700 border-b border-gray-200 w-44">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b border-gray-100">
                                    <td class="px-4 py-3 text-gray-700 border-r border-gray-200"
                                        id="uploaded-file-name">–</td>
                                    <td class="py-3 text-center border-r border-gray-200">
                                        <a href="#" id="download-link" title="Download file"
                                            class="inline-flex items-center justify-center text-gray-400 hover:text-blue-500 transition-colors duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="text-center px-4 py-3">
                                        <span
                                            class="inline-flex items-center gap-1.5 text-orange-500 text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full bg-orange-400 inline-block"></span>
                                            Pending
                                        </span>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b border-gray-100">
                                    <td class="px-4 py-3 text-gray-300 border-r border-gray-200">–</td>
                                    <td class="border-r border-gray-200"></td>
                                    <td class="px-4 py-3"></td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-3 text-gray-300 border-r border-gray-200">–</td>
                                    <td class="border-r border-gray-200"></td>
                                    <td class="px-4 py-3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Submit Project --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-2.5 rounded-xl shadow transition-all hover:shadow-md active:scale-95">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div> {{-- /wrapper Project Improvement --}}

        {{-- ══════════════════════════════ LOGBOOK ══════════════════════════════ --}}
        <div class="space-y-1">
            <div class="flex items-center gap-2.5 px-2" id="LogBook">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#4a5a6a]" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                </svg>
                <h2 class="text-xl font-bold text-[#4a5a6a]">LogBook</h2>
            </div>

            <div
                class="bg-gray-50 rounded-2xl shadow-sm p-6 border border-gray-200 fade-up flex items-center justify-between">
                <div class="pr-6">
                    <div class="flex items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#4a5a6a]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <h3 class="text-base font-bold text-[#4a5a6a]">Lihat rekap aktivitas LogBook kamu</h3>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">Pantau progress Exposure, Mentoring, dan Learning
                        secara lengkap klik tombol untuk melihat detail seluruh sesi.</p>
                </div>
                <a href="#"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold flex-shrink-0 px-6 py-2.5 rounded-xl text-sm shadow transition-all hover:shadow-md active:scale-95">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div> {{-- /wrapper LogBook --}}
    </div> <!-- Tutup w-full px-6 flex-grow wrapper -->

    {{-- ══════════════════════════════ FOOTER ══════════════════════════════ --}}
    <footer class="mt-auto bg-[#3d4f62]/90 backdrop-blur-sm shadow-md py-4 text-center w-full">
        <span class="text-white/80 text-sm font-medium tracking-wide">
            &copy; {{ date('Y') }} PT. Tiga Serangkai Inti Corpora
        </span>
    </footer>

</body>

<script>
    // Hide navbar on scroll down, show on scroll up
    (function() {
        const navbar = document.querySelector('.navbar-outer');
        let lastScrollY = window.scrollY;
        let ticking = false;

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const currentScrollY = window.scrollY;
                    if (currentScrollY > lastScrollY && currentScrollY > 80) {
                        // Scroll down — hide navbar
                        navbar.classList.add('nav-hidden');
                    } else {
                        // Scroll up — show navbar
                        navbar.classList.remove('nav-hidden');
                    }
                    lastScrollY = currentScrollY;
                    ticking = false;
                });
                ticking = true;
            }
        });
    })();
</script>

</html>
