<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\EstimasiBiaya;
use App\Models\User;
use Illuminate\Support\Str;

class EstimasiBiayaController extends Controller
{
    public function index()
    {
        $estimasibiaya = EstimasiBiaya::all();
        return view('estimasi-biaya.index', compact('estimasibiaya'));
    }

    public function create()
    {
        $users = User::all();
        return view('estimasi-biaya.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_estimasi' => 'required|unique:estimasi_biayas',
            'nama' => 'required',
            'no_polis' => 'required',
            'tipe_mobil' => 'required',
            'km_aktual' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'total_jasa' => 'required|numeric',
            'total_barang' => 'required|numeric',
            'id_user' => 'required|exists:users,id_user',
        ]);

        // Hitung total biaya
        $total_biaya = $request->total_jasa + $request->total_barang;
        
        // Tambahkan total_biaya ke request
        $data = $request->all();
        $data['total_biaya'] = $total_biaya;
        
        EstimasiBiaya::create($data);

        return redirect()->route('estimasi-biaya.index')
            ->with('success', 'Estimasi Biaya berhasil ditambahkan');
    }

    public function show(EstimasiBiaya $estimasibiaya)
    {
        return view('estimasi-biaya.show', compact('estimasibiaya'));
    }

    public function edit(EstimasiBiaya $estimasibiaya)
    {
        $users = User::all();
        return view('estimasi-biaya.edit', compact('estimasibiaya', 'users'));
    }

    public function update(Request $request, EstimasiBiaya $estimasibiaya)
    {
        $request->validate([
            'nama' => 'required',
            'no_polis' => 'required',
            'tipe_mobil' => 'required',
            'km_aktual' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'total_jasa' => 'required|numeric',
            'total_barang' => 'required|numeric',
            'id_user' => 'required|exists:users,id_user',
        ]);

        // Hitung total biaya
        $total_biaya = $request->total_jasa + $request->total_barang;
        
        // Tambahkan total_biaya ke request
        $data = $request->all();
        $data['total_biaya'] = $total_biaya;
        
        $estimasibiaya->update($data);

        return redirect()->route('estimasi-biaya.index')
            ->with('success', 'Estimasi Biaya berhasil diperbarui');
    }

    public function destroy(EstimasiBiaya $estimasibiaya)
    {
        $estimasibiaya->delete();

        return redirect()->route('estimasi-biaya.index')
            ->with('success', 'Estimasi Biaya berhasil dihapus');
    }
}