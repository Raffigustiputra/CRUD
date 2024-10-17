<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function exportExcel()
    {
        $users = User::all(); // Ambil semua data pengguna

        // Nama file yang akan di download
        $fileName = 'data_pengguna.csv';

        // Header untuk file CSV
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        // Membuka file output untuk di tulis
        $output = fopen('php://output', 'w');

        // Menulis header kolom
        fputcsv($output, ['No', 'Nama', 'Email', 'Role']);

        // Menulis data pengguna
        foreach ($users as $index => $user) {
            fputcsv($output, [($index + 1), $user->name, $user->email, $user->role]);
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
        $user = User::where('name', 'LIKE', '%' . $request->search_akun . '%')
            ->orderBy('name', 'ASC')
            ->simplePaginate(5);
        return view('User.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,


            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('user.data')->with('success', "Data user $request->name berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.data')->with('success', 'Berhasil mengupdate akun!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = User::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->back()->with('success', 'Berhasil menghapus data akun!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data akun!');
        }
    }
}
