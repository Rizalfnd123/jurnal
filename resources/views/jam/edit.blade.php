@extends('hm')

@section('title', 'Edit Jam')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Edit Data Jam</h1>
</div>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <div class="flex justify-between mb-4">
                    <h2 class="text-lg font-semibold">Edit Data Jam</h2>
                    <a href="{{ url('jam') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Kembali
                    </a>
                </div>
                <form action="{{ url('jam/' . $jam->id) }}" method="post" class="space-y-4">
                    @method('patch')
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="jam" class="block text-sm text-gray-700">Jam</label>
                            <input type="text" name="jam" id="jam"
                                class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ $jam->jam }}" autofocus required>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded transition duration-300">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
