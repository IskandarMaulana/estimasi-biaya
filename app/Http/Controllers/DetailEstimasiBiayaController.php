<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\DetailEstimasiBiaya;
use App\Models\EstimasiBiaya;
use App\Models\Part;
use App\Models\Material;
use App\Models\JasaVendor;
use App\Models\JasaBerkala;
use Illuminate\Support\Str;

class DetailEstimasiBiayaController extends Controller
{
    public function index()
    {
        $detailEstimasi = DetailEstimasiBiaya::with('estimasiBiaya')->get();
        return view('detail-estimasi.index', compact('detailEstimasi'));
    }

    public function create()
    {
        $estimasis = EstimasiBiaya::all();
        $parts = Part::all();
        $materials = Material::all();
        $jasaVendors = JasaVendor::all();
        $jasaBerkalas = JasaBerkala::all();
        
        return view('detail-estimasi.create', compact('estimasis', 'parts', 'materials', 'jasaVendors', 'jasaBerkalas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_estimasi' => 'required|exists:estimasi_biayas,id_estimasi',
            'nama' => 'required',
            'detail_type' => 'required|in:part,material,jasa_vendor,jasa_berkala',
            'harga_satuan' => 'required|numeric',
            'qty' => 'required|numeric|min:1',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        // Generate unique ID
        $id_detail_estimasi = 'DET' . date('YmdHis') . Str::random(3);
        
        // Calculate jumlah (total)
        $jumlah = $request->harga_satuan * $request->qty * (1 - $request->discount / 100);
        
        $data = $request->all();
        $data['id_detail_estimasi'] = $id_detail_estimasi;
        $data['jumlah'] = $jumlah;
        
        DetailEstimasiBiaya::create($data);
        
        // Update the total in EstimasiBiaya
        $this->updateEstimasiTotal($request->id_estimasi);

        return redirect()->route('detail-estimasi.index')
            ->with('success', 'Detail Estimasi Biaya berhasil ditambahkan');
    }

    public function show(DetailEstimasiBiaya $detailestimasibiaya)
    {
        return view('detail-estimasi.show', compact('detailestimasibiaya'));
    }

    public function edit(DetailEstimasiBiaya $detailestimasibiaya)
    {
        $estimasis = EstimasiBiaya::all();
        $parts = Part::all();
        $materials = Material::all();
        $jasaVendors = JasaVendor::all();
        $jasaBerkalas = JasaBerkala::all();
        
        return view('detail-estimasi.edit', compact('detailestimasibiaya', 'estimasis', 'parts', 'materials', 'jasaVendors', 'jasaBerkalas'));
    }

    public function update(Request $request, DetailEstimasiBiaya $detailestimasibiaya)
    {
        $request->validate([
            'id_estimasi' => 'required|exists:estimasi_biayas,id_estimasi',
            'nama' => 'required',
            'detail_type' => 'required|in:part,material,jasa_vendor,jasa_berkala',
            'harga_satuan' => 'required|numeric',
            'qty' => 'required|numeric|min:1',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        // Calculate jumlah (total)
        $jumlah = $request->harga_satuan * $request->qty * (1 - $request->discount / 100);
        
        $data = $request->all();
        $data['jumlah'] = $jumlah;
        
        $detailestimasibiaya->update($data);
        
        // Update the total in EstimasiBiaya
        $this->updateEstimasiTotal($request->id_estimasi);

        return redirect()->route('detail-estimasi.index')
            ->with('success', 'Detail Estimasi Biaya berhasil diperbarui');
    }

    public function destroy(DetailEstimasiBiaya $detailestimasibiaya)
    {
        // Store ID before deleting for later update
        $id_estimasi = $detailestimasibiaya->id_estimasi;
        
        $detailestimasibiaya->delete();
        
        // Update the total in EstimasiBiaya
        $this->updateEstimasiTotal($id_estimasi);

        return redirect()->route('detail-estimasi.index')
            ->with('success', 'Detail Estimasi Biaya berhasil dihapus');
    }
    
    private function updateEstimasiTotal($id_estimasi)
    {
        $estimasi = EstimasiBiaya::findOrFail($id_estimasi);
        $details = DetailEstimasiBiaya::where('id_estimasi', $id_estimasi)->get();
        
        $total_jasa = 0;
        $total_barang = 0;
        
        foreach ($details as $detail) {
            if ($detail->detail_type == 'jasa_vendor' || $detail->detail_type == 'jasa_berkala') {
                $total_jasa += $detail->jumlah;
            } else {
                $total_barang += $detail->jumlah;
            }
        }
        
        $estimasi->total_jasa = $total_jasa;
        $estimasi->total_barang = $total_barang;
        $estimasi->total_biaya = $total_jasa + $total_barang;
        $estimasi->save();
    }
}