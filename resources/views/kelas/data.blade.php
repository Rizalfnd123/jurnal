@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Kelas</h1>
</div>
@endsection

@section('content')
    <div class="content">
        <div class="animated fadeIn">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <strong class="text-lg font-semibold">Data Kelas</strong>
                    <a href="{{ url('kelas/add') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg">
                        <thead>
                            <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                                <th class="py-3 px-6 text-left" style="width: 50px;">No</th>
                                <th class="py-3 px-6 text-left">Kelas</th>
                                <th class="py-3 px-6 text-left" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($kelas as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}</td>
                                    <td class="py-3 px-6 text-left">{{ $item->kelas }}</td>
                                    <td class="py-3 px-6 text-left">
                                        <a href="{{ url('kelas/edit/' . $item->id) }}" class="mr-3">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('kelas/' . $item->id) }}" method="post" class="inline-block" onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="text-red-500">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Show pagination information and buttons -->
                    <div class="mt-3">
                        {{ $kelas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
