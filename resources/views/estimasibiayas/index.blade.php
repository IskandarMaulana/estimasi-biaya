@extends('shared.general.layouts')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Estimasi Biaya</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 mt-3">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm" onclick="reset()"><i
                                    class="fa fa-undo"></i> Reset</a>
                            @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                                <a href="{{ route('estimasibiayas.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"></i> Tambah Estimasi Biaya</a>
                            @endif
                            <br><br>
                            @if (session('success'))
                                <div class="alert alert-success mt-2">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card-box table-responsive">
                                <table id="datatable-fixed-header" class="table table-striped table-bordered"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px;"></th>
                                            <th><input type="text" class="form-control" id="nama_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="no_polis_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="tipe_mobil_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="km_aktual_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="tanggal_transaksi_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="total_jasa_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="total_barang_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="total_biaya_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th
                                                style="min-width: 60px; position: sticky; right: 0; background-color: #f2f2f2;">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>No. Polisi</th>
                                            <th>Tipe Mobil</th>
                                            <th>KM Aktual</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Total Jasa</th>
                                            <th>Total Barang</th>
                                            <th>Total Biaya</th>
                                            <th
                                                style="min-width: 60px; position: sticky; right: 0; background-color: #f2f2f2;">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($estimasiBiaya as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->nama }}</td>
                                                <td>{{ $row->no_polis }}</td>
                                                <td>{{ $row->tipe_mobil }}</td>
                                                <td>{{ number_format($row->km_aktual, 0, ',', '.') }} km</td>
                                                <td>{{ $row->tanggal_transaksi }}</td>
                                                <td>{{ 'Rp' . number_format($row->total_jasa, 2, ',', '.') }}</td>
                                                <td>{{ 'Rp' . number_format($row->total_barang, 2, ',', '.') }}</td>
                                                <td>{{ 'Rp' . number_format($row->total_biaya, 2, ',', '.') }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('estimasibiayas.show', $row->id_estimasi) }}"
                                                            class="btn-edit" data-placement="top" title="Detail"><i
                                                                class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var dataTable;

        $(document).ready(function () {
        });

        function reset() {
            $('#nama_filter').val('');
            $('#no_polis_filter').val('');
            $('#tipe_mobil_filter').val('');
            $('#km_aktual_filter').val('');
            $('#tanggal_transaksi_filter').val('');
            $('#total_jasa_filter').val('');
            $('#total_barang_filter').val('');
            $('#total_biaya_filter').val('');

            dataTable.search('').columns().search('').draw();
        }

        function search() {
            var nama = $('#nama_filter').val();
            var noPolis = $('#no_polis_filter').val();
            var tipeMobil = $('#tipe_mobil_filter').val();
            var kmAktual = $('#km_aktual_filter').val();
            var tanggalTransaksi = $('#tanggal_transaksi_filter').val();
            var totalJasa = $('#total_jasa_filter').val();
            var totalBarang = $('#total_barang_filter').val();
            var totalBiaya = $('#total_biaya_filter').val();

            dataTable.columns(1).search(nama);
            dataTable.columns(2).search(noPolis);
            dataTable.columns(3).search(tipeMobil);
            dataTable.columns(4).search(kmAktual);
            dataTable.columns(5).search(tanggalTransaksi);
            dataTable.columns(6).search(totalJasa);
            dataTable.columns(7).search(totalBarang);
            dataTable.columns(8).search(totalBiaya);
            dataTable.draw();
        }

        function handleKeyPress(event) {
            if (event.key === "Enter") {
                search();
            }
        }
    </script>
@endpush