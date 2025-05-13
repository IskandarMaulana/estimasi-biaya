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
            'no_part_eff' => 'required',
            'no_part_carb' => 'required',
            'harga_part_eff' => 'required|numeric',
            'harga_part_carb' => 'required|numeric',
            'stock_plan' => 'required|numeric',
            'stock_actual' => 'required|numeric',
        ]);

        $part = Part::create($request->all());
        $part->selisih = $part->stock_actual - $part->stock_plan;
        $part->save();

        return redirect()->route('parts.index')
            ->with('success', 'Part berhasil ditambahkan');
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
            'nama_part' => 'required',
            'tipe_mobil' => 'required',
            'no_part' => 'required',
            'no_part_eff' => 'required',
            'no_part_carb' => 'required',
            'harga_part_eff' => 'required|numeric',
            'harga_part_carb' => 'required|numeric',
            'stock_plan' => 'required|numeric',
            'stock_actual' => 'required|numeric',
        ]);

        $part->update($request->all());
        $part->selisih = $part->stock_actual - $part->stock_plan;
        $part->save();

        return redirect()->route('parts.index')
            ->with('success', 'Part berhasil diperbarui');
    }

    public function destroy(Part $part)
    {
        $part->delete();

        return redirect()->route('parts.index')
            ->with('success', 'Part berhasil dihapus');
    }
}