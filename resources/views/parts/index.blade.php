@extends('shared.general.layouts')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Master Data : Part</h3>
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
                                <a href="{{ route('parts.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                    Tambah Data</a>
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
                                            <th><input type="text" class="form-control" id="no_part_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="nama_part_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="tipe_mobil_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="harga_part_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th
                                                style="min-width: 120px; position: sticky; right: 0; background-color: #f2f2f2;">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>No.Part</th>
                                            <th>Nama Part</th>
                                            <th>Tipe Mobil</th>
                                            <th>Harga</th>
                                            <th
                                                style="min-width: 120px; position: sticky; right: 0; background-color: #f2f2f2;">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($parts as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->no_part }}</td>
                                                <td>{{ $row->nama_part }}</td>
                                                <td>{{ $row->tipe_mobil }}</td>
                                                <td>{{ 'Rp' . number_format($row->harga_part, 2, ',', '.') }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="btn-group mr-2" role="group">
                                                        @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                                                            <a href="{{ route('parts.edit', $row->id_part) }}" class="btn-edit" data-placement="top"
                                                                title="Perbarui"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                    </div>

                                                    <div class="btn-group ml-2" role="group">
                                                        @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                                                            <form action="{{ route('parts.destroy', $row->id_part) }}" method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-delete" data-placement="top" title="Hapus"
                                                                    style="background: none; border: none;">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </form>
                                                        @endif
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
            $('#nama_part_filter').val('');
            $('#tipe_mobil_filter').val('');
            $('#no_part_filter').val('');
            $('#harga_part_filter').val('');

            dataTable.search('').columns().search('').draw();
        }

        function search() {
            var namaPart = $('#nama_part_filter').val();
            var tipeMobil = $('#tipe_mobil_filter').val();
            var noPart = $('#no_part_filter').val();
            var hargaPart = $('#harga_part_filter').val();

            dataTable.columns(1).search(noPart);
            dataTable.columns(2).search(namaPart);
            dataTable.columns(3).search(tipeMobil);
            dataTable.columns(4).search(hargaPart);
            dataTable.draw();
        }

        function handleKeyPress(event) {
            if (event.key === "Enter") {
                search();
            }
        }
    </script>
@endpush