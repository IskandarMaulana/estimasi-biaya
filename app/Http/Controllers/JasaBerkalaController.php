<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\JasaBerkala;
use Illuminate\Support\Str;

class JasaBerkalaController extends Controller
{
    public function index()
    {
        $jasaBerkalas = JasaBerkala::all();
        return view('jasaberkalas.index', compact('jasaBerkalas'));
    }

    public function create()
    {
        $autoId = '';
        $lastRecord = JasaBerkala::orderBy('id_jasa', 'desc')->first();

        if (!$lastRecord) {
            $autoId = 'JSV00001';
        } else {
            $lastNumber = (int) substr($lastRecord->id_jasa, 3);

            $newNumber = $lastNumber + 1;

            $formattedNumber = str_pad($newNumber, 5, '0', STR_PAD_LEFT);
            $autoId = 'JSV' . $formattedNumber;
        }
        return view('jasaberkalas.create', compact('autoId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jasa' => 'required|unique:jasa_berkalas',
            'tipe_mobil' => 'required',
            'jenis_service' => 'required',
            'biaya_jasa' => 'required|numeric',
        ], [
            'id_jasa.required' => 'ID Jasa wajib diisi.',
            'id_jasa.unique' => 'ID Jasa sudah digunakan, gunakan ID lain.',

            'tipe_mobil.required' => 'Tipe Mobil wajib diisi.',

            'jenis_service.required' => 'Jenis Service wajib diisi.',

            'biaya_jasa.required' => 'Biaya Jasa wajib diisi.',
            'biaya_jasa.numeric' => 'Biaya Jasa harus berupa angka.'
        ]);

        try {
            $data = $request->all();
            JasaBerkala::create($data);

            return redirect()->route('jasaberkalas.index')
                ->with('success', 'Jasa Berkala berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan Jasa Berkala: ' . $e->getMessage()]);
        }
    }

    public function show(JasaBerkala $jasaberkala)
    {
        return view('jasaberkalas.show', compact('jasaberkala'));
    }

    public function edit(JasaBerkala $jasaberkala)
    {
        return view('jasaberkalas.edit', compact('jasaberkala'));
    }

    public function update(Request $request, JasaBerkala $jasaberkala)
    {
        $request->validate([
            'id_jasa' => 'required',
            'tipe_mobil' => 'required',
            'jenis_service' => 'required',
            'biaya_jasa' => 'required|numeric',
        ], [
            'id_jasa.required' => 'ID Jasa wajib diisi.',

            'tipe_mobil.required' => 'Tipe Mobil wajib diisi.',

            'jenis_service.required' => 'Jenis Service wajib diisi.',

            'biaya_jasa.required' => 'Biaya Jasa wajib diisi.',
            'biaya_jasa.numeric' => 'Biaya Jasa harus berupa angka.'
        ]);

        try {
            $data = $request->all();
            $jasaberkala->update($data);

            return redirect()->route('jasaberkalas.index')
                ->with('success', 'Jasa Berkala berhasil diperbarui');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui Jasa Berkala: ' . $e->getMessage()]);
        }
    }

    public function destroy(JasaBerkala $jasaberkala)
    {
        try {
            $jasaberkala->delete();

            return redirect()->route('jasaberkalas.index')
                ->with('success', 'Jasa Berkala berhasil dihapus');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal menghapus Jasa Berkala: ' . $e->getMessage()]);
        }
    }
}
