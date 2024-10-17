<?php

namespace App\Http\Controllers;

use App\Models\dataSiswa;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function exportExcel()
    {
        $data = dataSiswa::all(); // Ambil semua data pengguna

        // Nama file yang akan di download
        $fileName = 'DataSiswa.csv';

        // Header untuk file CSV
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        // Membuka file output untuk di tulis
        $output = fopen('php://output', 'w');

        // Menulis header kolom
        fputcsv($output, ['No', 'Nama', 'Nis', 'Rombel', 'Rayon', 'Eskul']);

        // Menulis data pengguna
        foreach ($data as $index => $user) {
            fputcsv($output, [($index + 1), $user->nama, $user->nis, $user->rombel, $user->rayon, $user->eskul]);
        }

        // Tutup file output
        fclose($output);
        exit();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = dataSiswa::where('nama', 'LIKE', '%' . $request->search_siswa . '%')
            ->orderBy('nama', 'ASC')
            ->simplePaginate(5);
        return view('Data.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'nis' => 'required|numeric',
            'rayon' => 'required',
            'rombel' => 'required',
            'eskul' => 'required',
        ]);

        // Menyimpan data pengguna baru ke database
        dataSiswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rayon' => $request->rayon,
            'rombel' => $request->rombel,
            'eskul' => $request->eskul,
        ]);

        // Mengarahkan pengguna ke daftar dengan pesan sukses
        return redirect()->route('siswa.data')->with('success', "Data user $request->name berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(dataSiswa $dataSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = dataSiswa::find($id);
        return view('Data.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { {
            // Validasi data yang dikirimkan
            $request->validate([
                'nama' => 'required|max:100',
                'nis' => 'required',
                'rayon' => 'required',
                'rombel' => 'required',
                'eskul' => 'required',
            ]);

            // Mencari user berdasarkan ID
            dataSiswa::where('id', $id)->update([

                'nama' => $request->nama,
                'nis' => $request->nis,
                'rayon' => $request->rayon,
                'rombel' => $request->rombel,
                'eskul' => $request->eskul,
            ]);


            // Redirect setelah update berhasil
            return redirect()->route('siswa.data')->with('success', 'Berhasil mengupdate akun!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = dataSiswa::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->back()->with('success', 'Berhasil menghapus data akun!');
        } else {

            return redirect()->back()->with('failed', 'Gagal menghapus data akun!');
        }
    }
}
