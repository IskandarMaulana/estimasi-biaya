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
        return view('jasavendors.index', compact('jasaVendors'));
    }

    public function create()
    {
        $autoId = '';
        $lastRecord = JasaVendor::orderBy('id_jasa', 'desc')->first();

        if (!$lastRecord) {
            $autoId = 'JSV00001';
        } else {
            $lastNumber = (int) substr($lastRecord->id_jasa, 3);

            $newNumber = $lastNumber + 1;

            $formattedNumber = str_pad($newNumber, 5, '0', STR_PAD_LEFT);
            $autoId = 'JSV' . $formattedNumber;
        }

        return view('jasavendors.create', compact('autoId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jasa' => 'required|unique:jasa_vendors',
            'jasa' => 'required',
            'harga' => 'required|numeric',
        ], [
            'id_jasa.required' => 'ID Jasa Vendor wajib diisi.',
            'id_jasa.unique' => 'ID Jasa Vendor sudah digunakan, gunakan ID lain.',

            'jasa.required' => 'Nama Jasa Vendor wajib diisi.',

            'harga.required' => 'Harga Jasa Vendor wajib diisi.',
            'harga.numeric' => 'Harga Jasa Vendor harus berupa angka.',
        ]);

        try {
            $data = $request->all();
            JasaVendor::create($data);

            return redirect()->route('jasavendors.index')
                ->with('success', 'Jasa Vendor berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan Jasa Vendor: ' . $e->getMessage()]);
        }
    }

    public function show(JasaVendor $jasavendor)
    {
        return view('jasavendors.show', compact('jasavendor'));
    }

    public function edit(JasaVendor $jasavendor)
    {
        return view('jasavendors.edit', compact('jasavendor'));
    }

    public function update(Request $request, JasaVendor $jasavendor)
    {
        $request->validate([
            'id_jasa' => 'required',
            'jasa' => 'required',
            'harga' => 'required|numeric',
        ], [
            'id_jasa.required' => 'ID Jasa Vendor wajib diisi.',

            'jasa.required' => 'Nama Jasa Vendor wajib diisi.',

            'harga.required' => 'Harga Jasa Vendor wajib diisi.',
            'harga.numeric' => 'Harga Jasa Vendor harus berupa angka.',
        ]);

        try {
            $data = $request->all();
            $jasavendor->update($data);

            return redirect()->route('jasavendors.index')
                ->with('success', 'Jasa Vendor berhasil diperbarui');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan Jasa Vendor: ' . $e->getMessage()]);
        }
    }

    public function destroy(JasaVendor $jasavendor)
    {
        try {
            $jasavendor->delete();

            return redirect()->route('jasavendors.index')
                ->with('success', 'Jasa Vendor berhasil dihapus');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan Jasa Vendor: ' . $e->getMessage()]);
        }
    }
}
