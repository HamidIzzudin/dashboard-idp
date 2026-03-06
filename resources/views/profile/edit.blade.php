<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>

<div class="max-w-5xl mx-auto py-10">

<h1 class="text-2xl font-bold mb-6">
Profil Kandidat
</h1>

<div class="grid grid-cols-2 gap-8">

<div>
<img src="/images/profile.jpg"
class="rounded-2xl shadow-lg">
</div>

<div class="space-y-4">

<p><b>Username</b> : {{ Auth::user()->name }}</p>
<p><b>Email</b> : {{ Auth::user()->email }}</p>

</div>

</div>

</div>

</x-app-layout>
