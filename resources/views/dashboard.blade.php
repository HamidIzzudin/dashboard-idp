<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-4">

        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.232.798 5.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <h1 class="text-2xl font-bold text-gray-800">Profil Kandidat</h1>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex gap-6 mb-8">

                <!-- Foto -->
                <div class="w-40 h-44 rounded-xl overflow-hidden bg-gray-200 flex-shrink-0">
                    @if($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}" class="w-full h-full object-cover" alt="Foto">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.232.798 5.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Info Akun -->
                <div class="flex-1">
                    <div class="bg-gray-700 text-white text-sm font-semibold px-4 py-1.5 rounded-t-lg inline-block mb-2">
                        Info Akun
                    </div>
                    <div class="border-b border-gray-200 mb-3"></div>
                    <div class="space-y-2 text-sm">
                        <div class="flex gap-4">
                            <span class="font-semibold text-gray-700 w-24">Username</span>
                            <span class="text-gray-600">{{ $user->username ?? $user->name }}</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="font-semibold text-gray-700 w-24">Email</span>
                            <span class="text-gray-600">{{ $user->email }}</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="font-semibold text-gray-700 w-24">Password</span>
                            <span class="text-gray-600 tracking-widest">•••••••</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Biodata -->
            <div>
            <div class="bg-gray-700 text-white text-sm font-semibold px-4 py-1.5 rounded-t-lg inline-block mb-2">
                    Biodata
                </div>
                <div class="border-b border-gray-200 mb-4"></div>
                <div class="grid grid-cols-2 gap-y-3 text-sm">
                <span class="font-semibold text-gray-700">Nama</span>
                <span class="text-gray-600">{{ $user->nama }}</span>

                <span class="font-semibold text-gray-700">Perusahaan</span>
                <span class="text-gray-600">{{ $user->perusahaan ?? '-' }}</span>

                <span class="font-semibold text-gray-700">Departemen</span>
                <span class="text-gray-600">{{ $user->departemen ?? '-' }}</span>

                <span class="font-semibold text-gray-700">Role</span>
                {{-- 'jabatan' = jabatan/role saat ini --}}
                <span class="text-gray-600">{{ $user->jabatan ?? '-' }}</span>

                <span class="font-semibold text-gray-700">Role Target</span>
                {{-- 'jabatan_target' = jabatan yang dituju --}}
                <span class="text-gray-600">{{ $user->jabatan_target ?? '-' }}</span>

                <span class="font-semibold text-gray-700">Mentor</span>
                <span class="text-gray-600">
                    {{ $user->mentor_id ? $user->mentor->nama : '-' }}
                </span>

                <span class="font-semibold text-gray-700">Atasan</span>
                <span class="text-gray-600">
                    {{ $user->atasan_id ? $user->atasan->nama : '-' }}
                </span>
            </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-between mt-8">
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg text-sm font-medium transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                        </svg>
                        Log Out
                    </button>
                </form>

                <!-- Edit -->
                <a href="{{ route('profile.edit') }}"
                   class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-medium transition">
                    Edit
                </a>
            </div>
        </div>
    </div>
</x-app-layout>