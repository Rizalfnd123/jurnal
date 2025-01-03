<?php

namespace App\Http\Controllers;

use App\Imports\MengajarImport;
use App\Models\Jam;
use App\Models\Mengajar;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Semester;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian
        $hari = $request->input('hari'); // Ambil input filter hari
        $sort_by = $request->input('sort_by', 'hari'); // Default sorting by 'hari'
        $order = $request->input('order', 'asc'); // Default order is ascending

        $mengajars = Mengajar::with(['jam', 'jamselesai', 'kelas', 'mapel', 'guru'])
            ->leftJoin('kelas', 'mengajars.kelas_id', '=', 'kelas.id') // Join tabel kelas
            ->leftJoin('jam', 'mengajars.jam_id', '=', 'jam.id') // Join tabel jam
            ->when($search, function ($query, $search) {
                return $query->where('hari', 'like', "%{$search}%")
                    ->orWhereHas('mapel', function ($query) use ($search) {
                        $query->where('mapel', 'like', "%{$search}%");
                    })
                    ->orWhereHas('guru', function ($query) use ($search) {
                        $query->where('nama', 'like', "%{$search}%");
                    });
            })
            ->when($hari, function ($query, $hari) {
                return $query->where('hari', $hari); // Filter hari lebih awal
            })
            ->orderBy(
                $sort_by == 'kelas' ? 'kelas.kelas' : ($sort_by == 'jam' ? 'jam.jam' : 'hari'),
                $order
            )
            ->select('mengajars.*') // Select data utama dari tabel mengajars
            ->paginate(20);

        // Ambil data tambahan
        $kelas = Kelas::all();
        $jam = Jam::all();
        $mapel = Mapel::all();
        $semester = Semester::all();
        $guru = Guru::all();
        $tapel = Tapel::all();

        // Kirim data ke view
        return view('mengajar.index', compact('mengajars', 'kelas', 'jam', 'mapel', 'guru', 'semester', 'tapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mengajar = Mengajar::all();
        $kelas = Kelas::all();
        $jam = Jam::all();
        $mapel = Mapel::all();
        $semester = Semester::all();
        $guru = Guru::all();
        $tapel = Tapel::all();
        return view('mengajar.create', compact('mengajar', 'kelas', 'jam', 'mapel', 'guru', 'semester', 'tapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_id' => 'required',
            'jamselesai_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'semester_id' => 'required',
            'tapel_id' => 'required',
            'guru_id' => 'required',
        ]);

        Mengajar::create([
            'hari' => $request->hari,
            'jam_id' => $request->jam_id,
            'jamselesai_id' => $request->jamselesai_id,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'semester_id' => $request->semester_id,
            'tapel_id' => $request->tapel_id,
            'guru_id' => $request->guru_id,
        ]);

        return redirect('mengajar')->with('success', 'Data berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mengajar = Mengajar::find($id);
        return $mengajar;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mengajar = Mengajar::find($id);
        $kelas = Kelas::all();
        $jam = Jam::all();
        $mapel = Mapel::all();
        $semester = Semester::all();
        $guru = Guru::all();
        $tapel = Tapel::all();
        // Ambil data lain yang diperlukan seperti $jam, $semester, dll.

        return view('mengajar.edit', compact('mengajar', 'kelas', 'jam', 'mapel', 'guru', 'semester', 'tapel'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'jam_id' => 'required',
            'jamselesai_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'semester_id' => 'required',
            'tapel_id' => 'required',
            'guru_id' => 'required',
        ]);

        $mengajar = Mengajar::findOrFail($id);
        $mengajar->update([
            'hari' => $request->hari,
            'jam_id' => $request->jam_id,
            'jamselesai_id' => $request->jamselesai_id,
            'kelas_id' => $request->kelas_id,
            'mapel_id' => $request->mapel_id,
            'semester_id' => $request->semester_id,
            'tapel_id' => $request->tapel_id,
            'guru_id' => $request->guru_id,
        ]);

        return redirect('mengajar')->with('success', 'Data berhasil diupdate.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mengajar = Mengajar::find($id);
        $mengajar->delete();
        return redirect('mengajar')->with('status', 'Jadwal berhasil dihapus');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Validasi file
        ]);

        Excel::import(new MengajarImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}
