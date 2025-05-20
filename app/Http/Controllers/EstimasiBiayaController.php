<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\DetailEstimasiBiaya;
use App\Models\EstimasiBiaya;
use App\Models\JasaBerkala;
use App\Models\JasaVendor;
use App\Models\Material;
use App\Models\Part;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\ServiceProvider;

class EstimasiBiayaController extends Controller
{
    public function index()
    {
        $estimasiBiaya = EstimasiBiaya::where('id_user', session('id_user'))->orderBy('created_at', 'desc')->get();
        if (session('role') != 'Service Advisor 1' && session('role') != 'Service Advisor 2' && session('role') != 'Service Advisor 3') {
            $estimasiBiaya = EstimasiBiaya::orderBy('created_at', 'desc')->get();
        }
        return view('estimasibiayas.index', compact('estimasiBiaya'));
    }

    public function create()
    {
        $users = User::all();
        $parts = Part::all();
        $materials = Material::all();
        $jasaBerkalas = JasaBerkala::all();
        $jasaVendors = JasaVendor::all();
        return view('estimasibiayas.create', compact('users', 'parts', 'materials', 'jasaBerkalas', 'jasaVendors'));
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

            'detail_jasa' => 'required_without:detail_part|array|min:1',
            'detail_part' => 'required_without:detail_jasa|array|min:1',
        ], [
            'id_estimasi.required' => 'ID Estimasi wajib diisi.',
            'id_estimasi.unique' => 'ID Estimasi sudah digunakan, gunakan ID lain.',

            'nama.required' => 'Nama wajib diisi.',
            'no_polis.required' => 'Nomor Polisi wajib diisi.',
            'tipe_mobil.required' => 'Tipe Mobil wajib diisi.',
            'km_aktual.required' => 'Kilometer Aktual wajib diisi.',
            'km_aktual.numeric' => 'Kilometer Aktual harus berupa angka.',
            'tanggal_transaksi.required' => 'Tanggal Transaksi wajib diisi.',
            'tanggal_transaksi.date' => 'Tanggal Transaksi harus berupa format tanggal yang valid.',
            'total_jasa.required' => 'Total Jasa wajib diisi.',
            'total_jasa.numeric' => 'Total Jasa harus berupa angka.',
            'total_barang.required' => 'Total Barang wajib diisi.',
            'total_barang.numeric' => 'Total Barang harus berupa angka.',
            'id_user.required' => 'User wajib sudah melakukan login.',
            'id_user.exists' => 'User yang login tidak ditemukan.',

            'detail_jasa.required_without' => 'Detail Jasa atau Detail Part salah satu harus diisi.',
            'detail_jasa.array' => 'Detail Jasa harus berupa array.',
            'detail_jasa.min' => 'Detail Jasa tidak boleh kosong jika Detail Part tidak diisi.',

            'detail_part.required_without' => 'Detail Part atau Detail Jasa salah satu harus diisi.',
            'detail_part.array' => 'Detail Part harus berupa array.',
            'detail_part.min' => 'Detail Part tidak boleh kosong jika Detail Jasa tidak diisi.',
        ]);

        try {

            $total_biaya = $request->total_jasa + $request->total_barang;

            $data = $request->all();
            $data['total_biaya'] = $total_biaya;

            $estimasiBiaya = EstimasiBiaya::create($data);

            if ($request->has('detail_jasa')) {
                foreach ($request->detail_jasa as $index => $jasaDetail) {
                    $id_detail = 'DTLEST' . substr($request->id_estimasi, 3) . '_' . strtoupper(substr($jasaDetail['detail_type'], 0, 1)) . $jasaDetail['id_ref'];

                    DetailEstimasiBiaya::create([
                        'id_detail_estimasi' => $id_detail,
                        'id_estimasi' => $request->id_estimasi,
                        'nama' => $jasaDetail['nama'],
                        'detail_type' => $jasaDetail['detail_type'],
                        'harga_satuan' => $jasaDetail['harga_satuan'],
                        'qty' => $jasaDetail['qty'],
                        'discount' => $jasaDetail['discount'],
                        'jumlah' => $jasaDetail['jumlah'],
                        'keterangan' => $jasaDetail['keterangan'] ?? null,
                    ]);
                }
            }

            if ($request->has('detail_part')) {
                foreach ($request->detail_part as $index => $partDetail) {
                    $id_detail = 'DTLEST' . substr($request->id_estimasi, 3) . '_' . strtoupper(substr($partDetail['detail_type'], 0, 1)) . $partDetail['id_ref'];

                    DetailEstimasiBiaya::create([
                        'id_detail_estimasi' => $id_detail,
                        'id_estimasi' => $request->id_estimasi,
                        'nama' => $partDetail['nama'],
                        'detail_type' => $partDetail['detail_type'],
                        'harga_satuan' => $partDetail['harga_satuan'],
                        'qty' => $partDetail['qty'],
                        'discount' => $partDetail['discount'],
                        'jumlah' => $partDetail['jumlah'],
                        'keterangan' => $partDetail['keterangan'] ?? null,
                    ]);
                }
            }

            $id_estimasi = $request->id_estimasi;
            return redirect()->route('estimasibiayas.show', $id_estimasi)
                ->with('success', 'Estimasi Biaya berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan Estimasi Biaya: ' . $e->getMessage()]);
        }
    }


    public function show($id_estimasi)
    {
        try {
            $estimasiBiaya = EstimasiBiaya::findOrFail($id_estimasi);

            $details = $estimasiBiaya->details;
            $jasaItems = $details->where('detail_type', 'jasa_berkala')
                ->merge($details->where('detail_type', 'jasa_vendor'));
            $partItems = $details->where('detail_type', 'part')
                ->merge($details->where('detail_type', 'material'));

            $estimasiBiaya->total_jasa_formatted = number_format($estimasiBiaya->total_jasa, 0, ',', '.');
            $estimasiBiaya->total_barang_formatted = number_format($estimasiBiaya->total_barang, 0, ',', '.');
            $estimasiBiaya->total_biaya_formatted = number_format($estimasiBiaya->total_biaya, 0, ',', '.');

            return view('estimasibiayas.show', compact('estimasiBiaya', 'jasaItems', 'partItems'));
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal mendapatkan data Estimasi Biaya: ' . $e->getMessage()]);
        }
    }

    public function exportPdf($id_estimasi)
    {
        try {
            $estimasiBiaya = EstimasiBiaya::findOrFail($id_estimasi);

            $details = $estimasiBiaya->details;
            $jasaItems = $details->where('detail_type', 'jasa_berkala')
                ->merge($details->where('detail_type', 'jasa_vendor'));
            $partItems = $details->where('detail_type', 'part')
                ->merge($details->where('detail_type', 'material'));

            $estimasiBiaya->total_jasa_formatted = number_format($estimasiBiaya->total_jasa, 0, ',', '.');
            $estimasiBiaya->total_barang_formatted = number_format($estimasiBiaya->total_barang, 0, ',', '.');
            $estimasiBiaya->total_biaya_formatted = number_format($estimasiBiaya->total_biaya, 0, ',', '.');

            $user = User::findOrFail($estimasiBiaya->id_user);

            $pdf = PDF::loadView('estimasibiayas.pdf', compact('estimasiBiaya', 'jasaItems', 'partItems', 'user'));
            $pdf->setPaper('a4', 'portrait');

            $filename = $estimasiBiaya->id_estimasi . '_' .
                str_replace(' ', '_', $estimasiBiaya->nama) . '_' .
                str_replace(' ', '_', $estimasiBiaya->no_polis) . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal mengexport PDF: ' . $e->getMessage()]);
        }
    }

    public function edit(EstimasiBiaya $estimasibiaya)
    {
        $users = User::all();
        return view('estimasibiayas.edit', compact('estimasibiaya', 'users'));
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

        try {
            $data = $request->all();
            $total_biaya = $request->total_jasa + $request->total_barang;

            $data = $request->all();
            $data['total_biaya'] = $total_biaya;

            $estimasibiaya->update($data);

            return redirect()->route('estimasibiayas.index')
                ->with('success', 'Estimasi Biaya berhasil diperbarui');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui Jasa Berkala: ' . $e->getMessage()]);
        }
    }

    public function destroy(EstimasiBiaya $estimasibiaya)
    {
        try {
            $estimasibiaya->delete();

            return redirect()->route('estimasibiayas.index')
                ->with('success', 'Estimasi Biaya berhasil dihapus');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal memperbarui Jasa Berkala: ' . $e->getMessage()]);
        }
    }
}
