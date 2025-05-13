<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\JasaVendor;
use Illuminate\Support\Str;

class JasaVendorController extends Controller
{
    public function index()
    {
        $jasaVendors = JasaVendor::all();
        return view('jasa-vendors.index', compact('jasaVendors'));
    }

    public function create()
    {
        return view('jasa-vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jasa' => 'required|unique:jasa_vendors',
            'jasa' => 'required',
            'harga' => 'required|numeric',
        ]);

        JasaVendor::create($request->all());

        return redirect()->route('jasa-vendors.index')
            ->with('success', 'Jasa Vendor berhasil ditambahkan');
    }

    public function show(JasaVendor $jasavendor)
    {
        return view('jasa-vendors.show', compact('jasavendor'));
    }

    public function edit(JasaVendor $jasavendor)
    {
        return view('jasa-vendors.edit', compact('jasavendor'));
    }

    public function update(Request $request, JasaVendor $jasavendor)
    {
        $request->validate([
            'jasa' => 'required',
            'harga' => 'required|numeric',
        ]);

        $jasavendor->update($request->all());

        return redirect()->route('jasa-vendors.index')
            ->with('success', 'Jasa Vendor berhasil diperbarui');
    }

    public function destroy(JasaVendor $jasavendor)
    {
        $jasavendor->delete();

        return redirect()->route('jasa-vendors.index')
            ->with('success', 'Jasa Vendor berhasil dihapus');
    }
}