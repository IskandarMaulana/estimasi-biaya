<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Part;
use Illuminate\Support\Str;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::all();
        return view('parts.index', compact('parts'));
    }

    public function create()
    {
        return view('parts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_part' => 'required|unique:parts',
            'nama_part' => 'required',
            'tipe_mobil' => 'required',
            'no_part' => 'required',
            'harga_part' => 'required|numeric'
        ], [
            'id_part.required' => 'ID Part wajib diisi.',
            'id_part.unique' => 'ID Part sudah digunakan, gunakan ID lain.',

            'nama_part.required' => 'Nama Part wajib diisi.',

            'tipe_mobil.required' => 'Tipe Mobil wajib diisi.',

            'no_part.required' => 'Nomor Part wajib diisi.',

            'harga_part.required' => 'Harga Part wajib diisi.',
            'harga_part.numeric' => 'Harga Part harus berupa angka.',
        ]);

        try {
            $data = $request->all();
            Part::create($data);

            return redirect()->route('parts.index')
                ->with('success', 'Part berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan Part: ' . $e->getMessage()]);
        }
    }

    public function show(Part $part)
    {
        return view('parts.show', compact('part'));
    }

    public function edit(Part $part)
    {
        return view('parts.edit', compact('part'));
    }

    public function update(Request $request, Part $part)
    {
        $request->validate([
            'id_part' => 'required|unique:parts',
            'nama_part' => 'required',
            'tipe_mobil' => 'required',
            'no_part' => 'required',
            'harga_part' => 'required|numeric'
        ], [
            'id_part.required' => 'ID Part wajib diisi.',
            'id_part.unique' => 'ID Part sudah digunakan, gunakan ID lain.',

            'nama_part.required' => 'Nama Part wajib diisi.',

            'tipe_mobil.required' => 'Tipe Mobil wajib diisi.',

            'no_part.required' => 'Nomor Part wajib diisi.',

            'harga_part.required' => 'Harga Part wajib diisi.',
            'harga_part.numeric' => 'Harga Part harus berupa angka.',
        ]);

        try {
            $data = $request->all();
            $part->update($data);

            return redirect()->route('parts.index')
                ->with('success', 'Part berhasil diperbarui');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal mengubah Part: ' . $e->getMessage()]);
        }
    }

    public function destroy(Part $part)
    {
        try {
            $part->delete();

            return redirect()->route('parts.index')
                ->with('success', 'Part berhasil dihapus');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal menghapus Part: ' . $e->getMessage()]);
        }
    }
}