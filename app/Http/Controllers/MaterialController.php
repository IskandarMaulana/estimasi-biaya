<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Material;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_material' => 'required|unique:materials',
            'nama_material' => 'required',
            'jenis_material' => 'required',
            'harga_satuan' => 'required|numeric',
        ], [
            'no_material.required' => 'Nomor Material wajib diisi.',
            'no_material.unique' => 'Nomor Material sudah ditambahkan, gunakan nomor atau material lain.',

            'nama_material.required' => 'Nama Material wajib diisi.',

            'jenis_material.required' => 'Jenis Material wajib diisi.',

            'harga_satuan.required' => 'Harga Satuan wajib diisi.',
            'harga_satuan.numeric' => 'Harga Satuan harus berupa angka.',
        ]);


        try {
            $data = $request->all();
            Material::create($data);

            return redirect()->route('materials.index')
                ->with('success', 'Material berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan Material: ' . $e->getMessage()]);
        }
    }

    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'no_material' => 'required',
            'nama_material' => 'required',
            'jenis_material' => 'required',
            'harga_satuan' => 'required|numeric',
        ], [
            'no_material.required' => 'Nomor Material wajib diisi.',

            'nama_material.required' => 'Nama Material wajib diisi.',

            'jenis_material.required' => 'Jenis Material wajib diisi.',

            'harga_satuan.required' => 'Harga Satuan wajib diisi.',
            'harga_satuan.numeric' => 'Harga Satuan harus berupa angka.',
        ]);

        try {
            $data = $request->all();
            $material->update($data);

            return redirect()->route('materials.index')
                ->with('success', 'Material berhasil diperbarui');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui Material: ' . $e->getMessage()]);
        }
    }

    public function destroy(Material $material)
    {
        try {
            $material->delete();

            return redirect()->route('materials.index')
                ->with('success', 'Material berhasil dihapus');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal menghapus Material: ' . $e->getMessage()]);
        }
    }
}