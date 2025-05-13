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
        ]);

        Material::create($request->all());

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil ditambahkan');
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
            'nama_material' => 'required',
            'jenis_material' => 'required',
            'harga_satuan' => 'required|numeric',
        ]);

        $material->update($request->all());

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil diperbarui');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material berhasil dihapus');
    }
}