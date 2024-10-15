@extends('hm')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="w-full px-2">
    <h1 class="text-3xl font-bold text-white mb-3">Tahun Pelajaran</h1>
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
                    <strong class="text-lg font-semibold">Data Tahun Pelajaran</strong>
                    <a href="{{ url('tapel/add') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg">
                        <thead>
                            <tr class="bg-amber-900 text-white uppercase text-xs leading-normal">
                                <th class="py-3 px-6 text-left" style="width: 50px;">No</th>
                                <th class="py-3 px-6 text-left">Tahun Pelajaran</th>
                                <th class="py-3 px-6 text-left">Status</th>
                                <th class="py-3 px-6 text-left" style="width: 80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($tapel as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-6 text-left">{{ $item->tapel }}</td>
                                    <td class="py-3 px-6 text-left">
                                        <span class="text-white py-1 px-3 rounded {{ $item->status == 'aktif' ? 'bg-green-500' : 'bg-gray-500' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <a href="{{ url('tapel/edit/' . $item->id) }}" class="mr-3 text-blue-500 hover:text-blue-700">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ url('tapel/' . $item->id) }}" method="post" class="inline-block" onsubmit="return confirm('Yakin hapus data?')">
                                            @method('delete')
                                            @csrf
                                            <button class="text-red-500 hover:text-red-700">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    {{-- <div class="mt-3">
                        {{ $tapel->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
