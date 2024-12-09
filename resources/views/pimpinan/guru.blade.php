@extends('hmpimpinan')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <div class="w-full px-2">
        <h1 class="text-3xl font-bold text-white mb-3">Guru</h1>
    </div>
@endsection

@section('content')
    <div class="w-full px-2">
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-4 flex flex-col sm:flex-row sm:justify-between items-start sm:items-center">
                <strong class="text-lg font-semibold mb-2 sm:mb-0">Data Guru</strong>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                    <!-- Form Import -->
                    
            
                    <!-- Tombol Tambah -->
                    {{-- <a href="{{ url('guru/add') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center w-full sm:w-auto">
                        <i class="fa fa-plus"></i> Tambah
                    </a> --}}
                </div>
            </div>            

            <!-- Tabel Data Guru -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg mx-auto">
                    <thead>
                        <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                            <th class="px-2 py-3 text-center">NIP</th>
                            <th class="px-2 py-3 text-center">Nama</th>
                            {{-- <th class="px-2 py-3 text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-xs font-light">
                        @foreach ($guru as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-2 py-3 text-center">{{ $item->nip }}</td>
                                <td class="px-2 py-3 text-center">{{ $item->nama }}</td>
                                {{-- <td class="px-2 py-3 text-center">
                                    <a href="{{ url('guru/edit/' . $item->id) }}" class="mr-2">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ url('guru/' . $item->id) }}" method="post" class="inline-block"
                                        onsubmit="return confirm('Yakin hapus data?')">
                                        @method('DELETE')
                                        @csrf
                                        <button class="text-red-500">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3 ">
                {{ $guru->links() }}
            </div>
        </div>
    </div>
@endsection
