<!-- resources/views/estimasibiayas/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Estimasi Biaya - {{ $estimasiBiaya->id_estimasi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table.header-table {
            margin-bottom: 20px;
            border: none;
        }

        table.header-table td {
            padding: 3px;
            vertical-align: top;
        }

        table.bordered {
            border: 1px solid #000;
        }

        table.bordered th,
        table.bordered td {
            border: 1px solid #000;
            padding: 5px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .logo-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .logo-table td {
            vertical-align: middle;
            border: none;
        }

        .logo-left {
            text-align: left;
            width: 30%;
        }

        .logo-center {
            text-align: center;
            width: 40%;
        }

        .logo-right {
            text-align: right;
            width: 30%;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .total-row {
            background-color: #f2f2f2;
        }

        .grand-total {
            background-color: #ffff99;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table style="width: 100%; margin-bottom: 20px">
            <tr>
                <td style="
                            width: 30%;
                            text-align: left;
                            vertical-align: middle;
                        ">
                    <img src="{{ public_path('assets/img/astra_logo.png') }}" alt="Astra International Logo"
                        style="height: 40px" />
                </td>
                <td style="
                            width: 40%;
                            text-align: center;
                            vertical-align: middle;
                        "></td>
                <td style="
                            width: 30%;
                            text-align: right;
                            vertical-align: middle;
                        ">
                    <img src="{{
    public_path('assets/img/Daihatsu_logo_2.png')
                            }}" alt="Daihatsu Logo" style="height: 40px" />
                </td>
            </tr>
        </table>
        <div class="title">BENGKEL ASTRA DAIHATSU BINTARO</div>
        <div class="subtitle">ESTIMASI BIAYA</div>

        <table class="header-table">
            <tr>
                <td width="15%"><strong>NAMA</strong></td>
                <td width="35%">: {{ $estimasiBiaya->nama }}</td>
                <td width="15%"></td>
                <td width="35%"></td>
            </tr>
            <tr>
                <td><strong>NO POLISI</strong></td>
                <td>: {{ $estimasiBiaya->no_polis }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>TIPE MOBIL</strong></td>
                <td>: {{ $estimasiBiaya->tipe_mobil }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>KM AKTUAL</strong></td>
                <td>: {{ $estimasiBiaya->km_aktual }}</td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <div class="section-title">URAIAN BIAYA</div>
        <div class="section-title">A. JASA</div>
        <table class="bordered">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="30%">JASA PERBAIKAN</th>
                    <th width="15%">HARGA SATUAN</th>
                    <th width="5%">QTY</th>
                    <th width="5%">DISC</th>
                    <th width="20%">JUMLAH</th>
                    <th width="20%">KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1;
                    $totalQtyJasa = 0;
                $totalDiscJasa = 0; @endphp
                @foreach($jasaItems as $jasa)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $jasa->nama }}</td>
                        <td class="text-right">
                            Rp
                            {{ number_format($jasa->harga_satuan, 2, ',', '.') }}
                        </td>
                        <td class="text-center">{{ $jasa->qty }}</td>
                        <td class="text-center">
                            {{ number_format($jasa->discount, 2, ',', '.') }}%
                        </td>
                        <td class="text-right">
                            Rp {{ number_format($jasa->jumlah, 2, ',', '.') }}
                        </td>
                        <td>{{ $jasa->keterangan }}</td>
                    </tr>
                    {{ $totalQtyJasa = $totalQtyJasa + $jasa->qty }}
                    {{ $totalDiscJasa = $totalDiscJasa + $jasa->discount }}
                @endforeach
                <tr class="total-row">
                    <td colspan="3" class="text-center">
                        <strong>TOTAL JASA</strong>
                    </td>
                    <td class="text-center">
                        <strong>{{ $totalQtyJasa }}</strong>
                    </td>
                    <td class="text-center">
                        <strong>{{
    number_format($totalDiscJasa, 2, ",", ".")
                                }}%</strong>
                    </td>
                    <td class="text-right">
                        <strong>Rp
                            {{ $estimasiBiaya->total_jasa_formatted }}</strong>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">B. PART/BAHAN</div>
        <table class="bordered">
            <thead>
                <tr>
                    <th width="5%">NO</th>
                    <th width="30%">NAMA PART</th>
                    <th width="15%">HARGA SATUAN</th>
                    <th width="5%">QTY</th>
                    <th width="5%">DISC</th>
                    <th width="20%">JUMLAH</th>
                    <th width="20%">KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1;
                    $totalQtyPart = 0;
                $totalDiscPart = 0; @endphp
                @foreach($partItems as $part)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $part->nama }}</td>
                        <td class="text-right">
                            Rp
                            {{ number_format($part->harga_satuan, 2, ',', '.') }}
                        </td>
                        <td class="text-center">{{ $part->qty }}</td>
                        <td class="text-center">
                            {{ number_format($part->discount, 2, ',', '.') }}%
                        </td>
                        <td class="text-right">
                            Rp {{ number_format($part->jumlah, 2, ',', '.') }}
                        </td>
                        <td>{{ $part->keterangan }}</td>
                    </tr>
                    {{ $totalQtyPart = $totalQtyPart + $part->qty }}
                    {{ $totalDiscPart = $totalDiscPart + $part->discount }}
                @endforeach
                <tr class="total-row">
                    <td colspan="3" class="text-center">
                        <strong>TOTAL BARANG</strong>
                    </td>
                    <td class="text-center">
                        <strong>{{ $totalQtyPart }}</strong>
                    </td>
                    <td class="text-center">
                        <strong>{{
    number_format($totalDiscPart, 2, ",", ".")
                                }}%</strong>
                    </td>
                    <td class="text-right">
                        <strong>Rp
                            {{ $estimasiBiaya->total_barang_formatted }}</strong>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%; margin-top: 20px">
            <tr>
                <td style="width: 60%"></td>
                <td style="width: 40%">
                    <table class="bordered">
                        {{--
                        <tr>
                            <td><strong>BIAYA MATERAI</strong></td>
                            <td class="text-right">Rp -</td>
                        </tr>
                        --}}
                        <tr class="grand-total">
                            <td><strong>TOTAL BIAYA</strong></td>
                            <td class="text-right">
                                <strong>Rp
                                    {{ $estimasiBiaya->total_biaya_formatted }}</strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="footer">
            <p><strong>Keterangan:</strong></p>
            <p>
                - Harga estimasi tidak mengikat, sewaktu waktu dapat berubah
                tanpa pemberitahuan
            </p>
            <p>
                - Apabila ada penambahan diluar estimasi ini akan
                diinformasikan lebih dahulu
            </p>
            <p>- Estimasi biaya perbaikan ini bukan bukti pembayaran</p>
            <p>- Harga sudah termasuk PPN</p>

            <div style="margin-top: 30px">
                <div style="text-align: right">
                    <div style="
                                display: inline-block;
                                width: 200px;
                                text-align: center;
                            ">
                        <p>DIBUAT OLEH</p>
                        <br /><br /><br />
                        <p>{{ $user->nama }}</p>
                        <p>_________________________</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>