@extends('shared.general.layouts') @section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Detail Estimasi Biaya</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 mt-3">
        <div class="x_panel">
            <div class="x_title">
                <h2>Informasi Estimasi</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (session('success'))
                <div class="alert alert-success mt-2">
                    {{ session("success") }}
                </div>
                @endif @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">ID Estimasi</th>
                                <td>: {{ $estimasiBiaya->id_estimasi }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>: {{ $estimasiBiaya->nama }}</td>
                            </tr>
                            <tr>
                                <th>No. Polisi</th>
                                <td>: {{ $estimasiBiaya->no_polis }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Mobil</th>
                                <td>: {{ $estimasiBiaya->tipe_mobil }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">KM Aktual</th>
                                <td>: {{ $estimasiBiaya->km_aktual }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <td>
                                    : {{ $estimasiBiaya->tanggal_transaksi }}
                                </td>
                            </tr>
                            <tr>
                                <th>Total Biaya</th>
                                <td>
                                    : Rp
                                    {{ $estimasiBiaya->total_biaya_formatted }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Jasa Section -->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Detail Jasa</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Nama Jasa</th>
                                <th style="width: 15%">Harga Satuan</th>
                                <th style="width: 8%">Qty</th>
                                <th style="width: 8%">Disc</th>
                                <th style="width: 15%">Jumlah</th>
                                <th style="width: 24%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; $totalQtyJasa = 0; $totalDiscJasa = 0;
                            foreach($jasaItems as $jasa) { $totalQtyJasa +=
                            $jasa->qty; $totalDiscJasa += $jasa->discount; }
                            @endphp @foreach ($jasaItems as $jasa)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $jasa->nama }}</td>
                                <td>
                                    Rp
                                    {{ number_format($jasa->harga_satuan, 2, ',', '.') }}
                                </td>
                                <td class="text-center">{{ $jasa->qty }}</td>
                                <td class="text-center">
                                    {{ number_format($jasa->discount, 2, ',', '.')

                                    }}%
                                </td>
                                <td>
                                    Rp
                                    {{ number_format($jasa->jumlah, 2, ',', '.') }}
                                </td>
                                <td>{{ $jasa->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right">
                                    <strong>Total Jasa</strong>
                                </td>
                                <td class="text-center">
                                    <strong>{{ $totalQtyJasa }}</strong>
                                </td>
                                <td class="text-center">
                                    <strong
                                        >{{
                                            number_format(
                                                $totalDiscJasa,
                                                2,
                                                ",",
                                                "."
                                            )
                                        }}%</strong
                                    >
                                </td>
                                <td>
                                    <strong
                                        >Rp
                                        {{ $estimasiBiaya->total_jasa_formatted }}</strong
                                    >
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Part Section -->
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Detail Part/Material</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 25%">Nama Part/Material</th>
                                <th style="width: 15%">Harga Satuan</th>
                                <th style="width: 8%">Qty</th>
                                <th style="width: 8%">Disc</th>
                                <th style="width: 15%">Jumlah</th>
                                <th style="width: 24%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; $totalQtyPart = 0; $totalDiscPart = 0;
                            foreach($partItems as $part) { $totalQtyPart +=
                            $part->qty; $totalDiscPart += $part->discount; }
                            @endphp @foreach ($partItems as $part)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $part->nama }}</td>
                                <td>
                                    Rp
                                    {{ number_format($part->harga_satuan, 2, ',', '.') }}
                                </td>
                                <td class="text-center">{{ $part->qty }}</td>
                                <td class="text-center">
                                    {{ number_format($part->discount, 2, ',', '.')

                                    }}%
                                </td>
                                <td>
                                    Rp
                                    {{ number_format($part->jumlah, 2, ',', '.') }}
                                </td>
                                <td>{{ $part->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right">
                                    <strong>Total Part/Material</strong>
                                </td>
                                <td class="text-center">
                                    <strong>{{ $totalQtyPart }}</strong>
                                </td>
                                <td class="text-center">
                                    <strong
                                        >{{
                                            number_format(
                                                $totalDiscPart,
                                                2,
                                                ",",
                                                "."
                                            )
                                        }}%</strong
                                    >
                                </td>
                                <td>
                                    <strong
                                        >Rp
                                        {{ $estimasiBiaya->total_barang_formatted }}</strong
                                    >
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Summary Section -->
<div class="row">
    <div class="col-md-8"></div>
    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_content">
                <table class="table table-bordered">
                    <tr>
                        <th>Total Jasa</th>
                        <td class="text-right">
                            Rp {{ $estimasiBiaya->total_jasa_formatted }}
                        </td>
                    </tr>
                    <tr>
                        <th>Total Part/Material</th>
                        <td class="text-right">
                            Rp {{ $estimasiBiaya->total_barang_formatted }}
                        </td>
                    </tr>
                    <tr class="bg-warning">
                        <th>TOTAL BIAYA</th>
                        <td class="text-right">
                            <strong
                                >Rp
                                {{ $estimasiBiaya->total_biaya_formatted }}</strong
                            >
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <a
            href="{{ route('estimasibiayas.index') }}"
            class="btn btn-secondary btn-sm"
            >Kembali</a
        >
        <a
            href="{{ route('estimasibiayas.export-pdf', $estimasiBiaya->id_estimasi) }}"
            class="btn btn-danger btn-sm"
            target="_blank"
        >
            <i class="fa fa-file-pdf-o"></i> Export PDF
        </a>
    </div>
</div>
@endsection
