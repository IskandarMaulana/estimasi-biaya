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
        $jasaberkalas = JasaBerkala::all();
        return view('jasa-berkalas.index', compact('jasaberkalas'));
    }

    public function create()
    {
        return view('jasa-berkalas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jasa' => 'required|unique:jasa_berkalas',
            'tipe_mobil' => 'required',
            'jenis_service' => 'required',
            'biaya_jasa' => 'required|numeric',
        ]);

        JasaBerkala::create($request->all());

        return redirect()->route('jasa-berkalas.index')
            ->with('success', 'Jasa Berkala berhasil ditambahkan');
    }

    public function show(JasaBerkala $jasaberkala)
    {
        return view('jasa-berkalas.show', compact('jasaberkala'));
    }

    public function edit(JasaBerkala $jasaberkala)
    {
        return view('jasa-berkalas.edit', compact('jasaberkala'));
    }

    public function update(Request $request, JasaBerkala $jasaberkala)
    {
        $request->validate([
            'tipe_mobil' => 'required',
            'jenis_service' => 'required',
            'biaya_jasa' => 'required|numeric',
        ]);

        $jasaberkala->update($request->all());

        return redirect()->route('jasa-berkalas.index')
            ->with('success', 'Jasa Berkala berhasil diperbarui');
    }

    public function destroy(JasaBerkala $jasaberkala)
    {
        $jasaberkala->delete();

        return redirect()->route('jasa-berkalas.index')
            ->with('success', 'Jasa Berkala berhasil dihapus');
    }
}