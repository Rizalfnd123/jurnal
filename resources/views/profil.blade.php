<!-- resources/views/guru/profile.blade.php -->

@extends('hmguru') <!-- Sesuaikan dengan layout yang digunakan -->
@section('title', 'Dashboard')

@section('breadcrumbs')
    {{-- <div class="w-full px-6">
        <h3 class="text-3xl font-bold text-white mb-3">Profil Guru</h3>
    </div> --}}
@endsection
@section('content')
<div class="container mx-auto p-6 bg-white shadow rounded-lg max-w-md mt-10">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Profil Guru</h2>

    <div class="text-center mb-6">
        <img class="w-24 h-24 rounded-full mx-auto mb-3" src="{{ asset('images/' . ($guru->foto ?? 'admin.jpg')) }}"  alt="Avatar Guru">
        <h3 class="text-xl font-bold">{{ $guru->nama }}</h3>
        <p class="text-gray-600">{{ $guru->nip }}</p>
    </div>

    <div class="space-y-4">
        <div>
            <h4 class="text-gray-700 font-medium">Email</h4>
            <p class="text-gray-800">{{ $guru->username }}</p>
        </div>
        
        <div>
            <h4 class="text-gray-700 font-medium">Jenis Kelamin</h4>
            <p class="text-gray-800">{{ $guru->kelamin }}</p>
        </div>
        
        
        <div class="text-center mt-6">
            <a href="" class="px-4 py-2 bg-amber-900 text-white font-semibold rounded-full hover:bg-amber-800 shadow-lg">
                Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
