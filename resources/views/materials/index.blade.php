@extends('shared.general.layouts')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Master Data : Material</h3>
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
                                <a href="{{ route('materials.create') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-plus"></i> Tambah Data</a>
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
                                            <th><input type="text" class="form-control" id="no_material_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="nama_material_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="jenis_material_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th><input type="text" class="form-control" id="harga_satuan_filter"
                                                    onkeypress="handleKeyPress(event)"></th>
                                            <th
                                                style="min-width: 120px; position: sticky; right: 0; background-color: #f2f2f2;">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>No.Material</th>
                                            <th>Nama Material</th>
                                            <th>Jenis Material</th>
                                            <th>Harga</th>
                                            <th
                                                style="min-width: 120px; position: sticky; right: 0; background-color: #f2f2f2;">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($materials as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->no_material }}</td>
                                                <td>{{ $row->nama_material }}</td>
                                                <td>{{ $row->jenis_material }}</td>
                                                <td>{{ 'Rp' . number_format($row->harga_satuan, 2, ',', '.') }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="btn-group mr-2" role="group">
                                                        @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                                                            <a href="{{ route('materials.edit', $row->id_material) }}"
                                                                class="btn-edit" data-placement="top" title="Perbarui"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                    </div>

                                                    <div class="btn-group ml-2" role="group">
                                                        @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                                                            <form action="{{ route('materials.destroy', $row->id_material) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn-delete" data-placement="top"
                                                                    title="Hapus" style="background: none; border: none;">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                        @endif
                                                        </form>
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
            $('#no_material_filter').val('');
            $('#nama_material_filter').val('');
            $('#jenis_material_filter').val('');
            $('#harga_satuan_filter').val('');

            dataTable.search('').columns().search('').draw();
        }

        function search() {
            var noMaterial = $('#no_material_filter').val();
            var namaMaterial = $('#nama_material_filter').val();
            var jenisMaterial = $('#jenis_material_filter').val();
            var hargaSatuan = $('#harga_satuan_filter').val();

            dataTable.columns(1).search(noMaterial);
            dataTable.columns(2).search(namaMaterial);
            dataTable.columns(3).search(jenisMaterial);
            dataTable.columns(4).search(hargaSatuan);
            dataTable.draw();
        }

        function handleKeyPress(event) {
            if (event.key === "Enter") {
                search();
            }
        }
    </script>
@endpush