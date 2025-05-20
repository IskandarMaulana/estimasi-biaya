@extends('shared.general.layouts')
@section('content')
    <style>
        #jasaBerkalaTable {
            width: 100% !important;
        }

        .filter-row input {
            width: 100%;
            box-sizing: border-box;
        }

        #jasaBerkalaTable thead th {
            vertical-align: middle;
        }

        #jasaBerkalaTable thead tr.filter-row th {
            padding: 5px;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Tambah Estimasi Biaya</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('estimasibiayas.store') }}" method="POST" id="estimasiForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label>ID Estimasi<span style="color: red;"> *</span></label>
                                    <input type="text" id="id_estimasi" name="id_estimasi" required class="form-control"
                                        value="{{ 'EST' . date('YmdHis') }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label>Nama<span style="color: red;"> *</span></label>
                                    <input type="text" id="nama" name="nama" required class="form-control"
                                        value="{{ old('nama') }}">
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label>No. Polisi<span style="color: red;"> *</span></label>
                                    <input type="text" id="no_polis" name="no_polis" required class="form-control"
                                        value="{{ old('no_polis') }}">
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label>Tipe Mobil<span style="color: red;"> *</span></label>
                                    <select class="form-control" id="tipe_mobil" name="tipe_mobil" required>
                                        <option value="" disabled selected>Pilih Tipe Mobil</option>
                                        <option value="Daihatsu Sigra">Daihatsu Sigra</option>
                                        <option value="Daihatsu Xenia">Daihatsu Xenia</option>
                                        <option value="Daihatsu Ayla">Daihatsu Ayla</option>
                                        <option value="Daihatsu Sirion">Daihatsu Sirion</option>
                                        <option value="Daihatsu Granmax">Daihatsu Granmax</option>
                                        <option value="Daihatsu Luxio">Daihatsu Luxio</option>
                                        <option value="Daihatsu Rocky">Daihatsu Rocky</option>
                                        <option value="Daihatsu Terios Old">Daihatsu Terios Old</option>
                                        <option value="Daihatsu Terios All New">Daihatsu Terios All New</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label>KM Aktual<span style="color: red;"> *</span></label>
                                    <input type="number" id="km_aktual" name="km_aktual" required class="form-control"
                                        value="{{ old('km_aktual') }}">
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label>Tanggal Transaksi<span style="color: red;"> *</span></label>
                                    <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" required
                                        class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>

                            <!-- Hidden fields for totals and user ID -->
                            <input type="hidden" id="total_jasa" name="total_jasa" value="0">
                            <input type="hidden" id="total_barang" name="total_barang" value="0">
                            <input type="hidden" id="id_user" name="id_user" value="{{ session('id_user') }}">
                        </div>

                        <!-- Card for Jasa (Services) -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>A. JASA</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="jasaTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">NO</th>
                                                <th width="30%">JASA PERBAIKAN</th>
                                                <th width="15%">HARGA SATUAN</th>
                                                <th width="10%">QTY</th>
                                                <th width="10%">DISC (%)</th>
                                                <th width="15%">JUMLAH</th>
                                                <th width="10%">KETERANGAN</th>
                                                <th width="5%">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be added dynamically via JavaScript -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-right"><strong>TOTAL JASA</strong></td>
                                                <td><span id="jasaTotalDisplay">Rp 0</span></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#jasaModal">
                                        <i class="fa fa-plus"></i> Tambah Jasa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card for Part Bahan (Parts) -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>B. PART BAHAN</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="partTable">
                                        <thead>
                                            <tr>
                                                <th width="5%">NO</th>
                                                <th width="30%">NAMA PART</th>
                                                <th width="15%">HARGA SATUAN</th>
                                                <th width="10%">QTY</th>
                                                <th width="10%">DISC (%)</th>
                                                <th width="15%">JUMLAH</th>
                                                <th width="10%">KETERANGAN</th>
                                                <th width="5%">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows will be added dynamically via JavaScript -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-right"><strong>TOTAL PART</strong></td>
                                                <td><span id="partTotalDisplay">Rp 0</span></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#partModal">
                                        <i class="fa fa-plus"></i> Tambah Part
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Grand Total Section -->
                        <div class="row mt-4">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <!-- <tr>
                                                                                                                                                                                        <th>BIAYA MATERIAL</th>
                                                                                                                                                                                        <td class="text-right"><span id="materialTotalDisplay">Rp 0</span></td>
                                                                                                                                                                                    </tr> -->
                                    <tr class="bg-warning">
                                        <th>TOTAL BIAYA</th>
                                        <td class="text-right"><strong><span id="grandTotalDisplay">Rp 0</span></strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4">
                            <a href="{{ route('estimasibiayas.index') }}"
                                class="btn btn-outline-secondary btn-back btn-sm">Kembali</a>
                            @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                                <button type="submit" class="btn btn-primary btn-submit btn-sm">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding Jasa -->
    <div class="modal fade" id="jasaModal" tabindex="-1" role="dialog" aria-labelledby="jasaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jasaModalLabel">Tambah Jasa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="jasaTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="jasaBerkala-tab" data-toggle="tab" href="#jasaBerkala" role="tab"
                                aria-controls="jasaBerkala" aria-selected="true">Jasa Berkala</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="jasaVendor-tab" data-toggle="tab" href="#jasaVendor" role="tab"
                                aria-controls="jasaVendor" aria-selected="false">Jasa Vendor</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="jasaTabContent">
                        <!-- Jasa Berkala Tab -->
                        <div class="tab-pane fade show active" id="jasaBerkala" role="tabpanel"
                            aria-labelledby="jasaBerkala-tab">
                            <div class="form-group mt-3">
                                <label>Filter Tipe Mobil:</label>
                                <select class="form-control" id="filterJasaBerkalaTipe">
                                    <option value="">Semua Tipe</option>
                                    <option value="Daihatsu Sigra">Daihatsu Sigra</option>
                                    <option value="Daihatsu Xenia">Daihatsu Xenia</option>
                                    <option value="Daihatsu Ayla">Daihatsu Ayla</option>
                                    <option value="Daihatsu Sirion">Daihatsu Sirion</option>
                                    <option value="Daihatsu Granmax">Daihatsu Granmax</option>
                                    <option value="Daihatsu Luxio">Daihatsu Luxio</option>
                                    <option value="Daihatsu Rocky">Daihatsu Rocky</option>
                                    <option value="Daihatsu Terios Old">Daihatsu Terios Old</option>
                                    <option value="Daihatsu Terios All New">Daihatsu Terios All New</option>
                                </select>
                            </div>
                            <table class="table table-bordered" id="jasaBerkalaTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th><input type="text" class="form-control" id="tipe_mobil_filter"></th>
                                        <th><input type="text" class="form-control" id="jenis_service_filter"></th>
                                        <th><input type="text" class="form-control" id="biaya_jasa_filter"></th>
                                    </tr>
                                    <tr>
                                        <th><input name="select_all" value="1" id="checkSelectAllJasaBerkala"
                                                type="checkbox" /></th>
                                        <th>No.</th>
                                        <th>Tipe Mobil</th>
                                        <th>Jenis Service</th>
                                        <th>Biaya Jasa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $noJasaBerkala = 1; @endphp
                                    @foreach($jasaBerkalas as $jasa)
                                        <tr data-tipe="{{ $jasa->tipe_mobil }}">
                                            <td data-id="{{ $jasa->id_jasa }}" data-nama="{{ $jasa->jenis_service }}"
                                                data-harga="{{ $jasa->biaya_jasa }}"></td>
                                            <td>{{ $noJasaBerkala++ }}</td>
                                            <td>{{ $jasa->tipe_mobil }}</td>
                                            <td>{{ $jasa->jenis_service }}</td>
                                            <td>Rp {{ number_format($jasa->biaya_jasa, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Jasa Vendor Tab -->
                        <div class="tab-pane fade" id="jasaVendor" role="tabpanel" aria-labelledby="jasaVendor-tab">
                            <table class="table table-bordered mt-3" id="jasaVendorTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th><input type="text" class="form-control" id="jasa_vendor_filter"></th>
                                        <th><input type="text" class="form-control" id="harga_jasa_filter"></th>
                                    </tr>
                                    <tr>
                                        <th><input name="select_all" value="1" id="checkSelectAllJasaVendor"
                                                type="checkbox" /></th>
                                        <th>No.</th>
                                        <th>Jasa</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $noJasaVendor = 1; @endphp
                                    @foreach($jasaVendors as $jasa)
                                        <tr>
                                            <td data-id="{{ $jasa->id_jasa }}" data-nama="{{ $jasa->jasa }}"
                                                data-harga="{{ $jasa->harga }}"></td>
                                            <td>{{ $noJasaVendor++ }}</td>
                                            <td>{{ $jasa->jasa }}</td>
                                            <td>Rp {{ number_format($jasa->harga, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                        <button type="button" class="btn btn-primary" id="btnTambahJasa">Tambah Jasa</button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding Part -->
    <div class="modal fade" id="partModal" tabindex="-1" role="dialog" aria-labelledby="partModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="partModalLabel">Tambah Part/Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="partTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="part-tab" data-toggle="tab" href="#partList" role="tab"
                                aria-controls="partList" aria-selected="true">Part</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="material-tab" data-toggle="tab" href="#materialList" role="tab"
                                aria-controls="materialList" aria-selected="false">Material</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="partTabContent">
                        <!-- Part Tab -->
                        <div class="tab-pane fade show active" id="partList" role="tabpanel" aria-labelledby="part-tab">
                            <div class="form-group mt-3">
                                <label>Filter Tipe Mobil:</label>
                                <select class="form-control" id="filterPartTipe">
                                    <option value="">Semua Tipe</option>
                                    <option value="Daihatsu Sigra">Daihatsu Sigra</option>
                                    <option value="Daihatsu Xenia">Daihatsu Xenia</option>
                                    <option value="Daihatsu Ayla">Daihatsu Ayla</option>
                                    <option value="Daihatsu Sirion">Daihatsu Sirion</option>
                                    <option value="Daihatsu Granmax">Daihatsu Granmax</option>
                                    <option value="Daihatsu Luxio">Daihatsu Luxio</option>
                                    <option value="Daihatsu Rocky">Daihatsu Rocky</option>
                                    <option value="Daihatsu Terios Old">Daihatsu Terios Old</option>
                                    <option value="Daihatsu Terios All New">Daihatsu Terios All New</option>
                                </select>
                            </div>
                            <table class="table table-bordered" id="partMasterTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th><input type="text" class="form-control" id="part_tipe_filter"></th>
                                        <th><input type="text" class="form-control" id="part_nama_filter"></th>
                                        <th><input type="text" class="form-control" id="part_harga_filter"></th>
                                    </tr>
                                    <tr>
                                        <th><input name="select_all" value="1" id="checkSelectAllPart" type="checkbox" />
                                        </th>
                                        <th>No.</th>
                                        <th>Tipe Mobil</th>
                                        <th>Nama Part</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $noPart = 1; @endphp
                                    @foreach($parts as $part)
                                        <tr data-tipe="{{ $part->tipe_mobil }}">
                                            <td data-id="{{ $part->id_part }}" data-nama="{{ $part->nama_part }}"
                                                data-harga="{{ $part->harga_part }}"></td>
                                            <td>{{ $noPart++ }}</td>
                                            <td>{{ $part->tipe_mobil }}</td>
                                            <td>{{ $part->nama_part }}</td>
                                            <td>Rp {{ number_format($part->harga_part, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Material Tab -->
                        <div class="tab-pane fade" id="materialList" role="tabpanel" aria-labelledby="material-tab">
                            <table class="table table-bordered mt-3" id="materialTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th><input type="text" class="form-control" id="material_nama_filter"></th>
                                        <th><input type="text" class="form-control" id="material_jenis_filter"></th>
                                        <th><input type="text" class="form-control" id="material_harga_filter"></th>
                                    </tr>
                                    <tr>
                                        <th><input name="select_all" value="1" id="checkSelectAllMaterial"
                                                type="checkbox" /></th>
                                        <th>No.</th>
                                        <th>Nama Material</th>
                                        <th>Jenis Material</th>
                                        <th>Harga Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $noMaterial = 1; @endphp
                                    @foreach($materials as $material)
                                        <tr>
                                            <td data-id="{{ $material->id_material }}"
                                                data-nama="{{ $material->nama_material }}"
                                                data-harga="{{ $material->harga_satuan }}"></td>
                                            <td>{{ $noMaterial++ }}</td>
                                            <td>{{ $material->nama_material }}</td>
                                            <td>{{ $material->jenis_material }}</td>
                                            <td>Rp {{ number_format($material->harga_satuan, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                        <button type="button" class="btn btn-primary" id="btnTambahPart">Tambah Part</button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            let jasaBerkalaTable = $('#jasaBerkalaTable').DataTable({
                autoWidth: false,
                responsive: true,
                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false,
                        className: 'dt-body-center',
                        width: '20px',
                        render: function (data, type, full, meta) {
                            return '<input type="checkbox" name="jasaBerkala[]" value="' + meta.row + '">';
                        }
                    },
                    {
                        orderable: false,
                        targets: 1,
                        width: '40px'
                    },
                    {
                        targets: [2, 3, 4],
                        width: 'auto'
                    }
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ],
                searching: true
            });

            $('#checkSelectAllJasaBerkala').on('click', function () {
                const isChecked = this.checked;
                $('#jasaBerkalaTable input[name="jasaBerkala[]"]').prop('checked', isChecked);
            });

            $(document).on('change', '#jasaBerkalaTable input[name="jasaBerkala[]"]', function () {
                const totalCheckboxes = $('#jasaBerkalaTable input[name="jasaBerkala[]"]').length;
                const checkedCheckboxes = $('#jasaBerkalaTable input[name="jasaBerkala[]"]:checked').length;

                $('#checkSelectAllJasaBerkala').prop('checked', totalCheckboxes === checkedCheckboxes);
            });


            let jasaVendorTable = $('#jasaVendorTable').DataTable({
                autoWidth: false,
                responsive: true,
                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false,
                        className: 'dt-body-center',
                        width: '20px',
                        render: function (data, type, full, meta) {
                            return '<input type="checkbox" name="jasaVendor[]" value="' + meta.row + '">';
                        }
                    },
                    {
                        orderable: false,
                        targets: 1,
                        width: '40px'
                    },
                    {
                        targets: [2, 3],
                        width: 'auto'
                    }
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ],
                searching: true
            });

            $('#checkSelectAllJasaVendor').on('click', function () {
                const isChecked = this.checked;
                $('#jasaVendorTable input[name="jasaVendor[]"]').prop('checked', isChecked);
            });

            $(document).on('change', '#jasaVendorTable input[name="jasaVendor[]"]', function () {
                const totalCheckboxes = $('#jasaVendorTable input[name="jasaVendor[]"]').length;
                const checkedCheckboxes = $('#jasaVendorTable input[name="jasaVendor[]"]:checked').length;

                $('#checkSelectAllJasaVendor').prop('checked', totalCheckboxes === checkedCheckboxes);
            });


            let partMasterTable = $('#partMasterTable').DataTable({
                autoWidth: false,
                responsive: true,
                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false,
                        className: 'dt-body-center',
                        width: '20px',
                        render: function (data, type, full, meta) {
                            return '<input type="checkbox" name="part[]" value="' + meta.row + '">';
                        }
                    },
                    {
                        orderable: false,
                        targets: 1,
                        width: '40px'
                    },
                    {
                        targets: [2, 3],
                        width: 'auto'
                    }
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ],
                searching: true
            });

            $('#checkSelectAllPart').on('click', function () {
                const isChecked = this.checked;
                $('#partMasterTable input[name="part[]"]').prop('checked', isChecked);
            });

            $(document).on('change', '#partMasterTable input[name="part[]"]', function () {
                const totalCheckboxes = $('#partMasterTable input[name="part[]"]').length;
                const checkedCheckboxes = $('#partMasterTable input[name="part[]"]:checked').length;

                $('#checkSelectAllPart}').prop('checked', totalCheckboxes === checkedCheckboxes);
            });

            let materialTable = $('#materialTable').DataTable({
                autoWidth: false,
                responsive: true,
                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false,
                        className: 'dt-body-center',
                        width: '20px',
                        render: function (data, type, full, meta) {
                            return '<input type="checkbox" name="material[]" value="' + meta.row + '">';
                        }
                    },
                    {
                        orderable: false,
                        targets: 1,
                        width: '40px'
                    },
                    {
                        targets: [2, 3],
                        width: 'auto'
                    }
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ],
                searching: true
            });

            $('#checkSelectAllMaterial').on('click', function () {
                const isChecked = this.checked;
                $('#materialTable input[name="material[]"]').prop('checked', isChecked);
            });

            $(document).on('change', '#materialTable input[name="material[]"]', function () {
                const totalCheckboxes = $('#materialTable input[name="material[]"]').length;
                const checkedCheckboxes = $('#materialTable input[name="material[]"]:checked').length;

                $('#checkSelectAllMaterial').prop('checked', totalCheckboxes === checkedCheckboxes);
            });

            $(document).on('keypress', '#tipe_mobil_filter, #jenis_service_filter, #biaya_jasa_filter', function (event) {
                if (event.key === "Enter") {
                    console.log('Pressed')
                    searchJasaBerkala();
                }
            });

            $(document).on('keypress', '#jasa_vendor_filter, #harga_jasa_filter', function (event) {
                if (event.key === "Enter") {
                    searchJasaVendor();
                }
            });

            $(document).on('keypress', '#part_filter_input', function (event) {
                if (event.key === "Enter") {
                    searchPart();
                }
            });

            $(document).on('keypress', '#material_filter_input', function (event) {
                if (event.key === "Enter") {
                    searchMaterial();
                }
            });

            let jasaItems = [];
            let partItems = [];
            let jasaCounter = 1;
            let partCounter = 1;

            function formatRupiah(angka) {
                return 'Rp ' + parseFloat(angka).toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,');
            }

            function calculateRowTotal(hargaSatuan, qty, discount) {
                return hargaSatuan * qty * (1 - discount / 100);
            }

            function updateTotals() {
                let totalJasa = 0;
                let totalPart = 0;
                let totalBiaya = 0;

                // Calculate jasa total
                jasaItems.forEach(item => {
                    totalJasa += parseFloat(item.jumlah);
                });

                // Calculate part total
                partItems.forEach(item => {
                    totalPart += parseFloat(item.jumlah);
                });

                totalBiaya = totalJasa + totalPart;
                // Update displays
                $('#jasaTotalDisplay').text(formatRupiah(totalJasa));
                $('#partTotalDisplay').text(formatRupiah(totalPart));
                $('#materialTotalDisplay').text(formatRupiah(totalPart));
                $('#grandTotalDisplay').text(formatRupiah(totalBiaya));

                // Update hidden fields for form submission
                $('#total_jasa').val(totalJasa);
                $('#total_barang').val(totalPart);
            }

            $(document).on('change', '#jasaTable .qty', function () {
                const row = $(this).data('row');
                const hargaSatuan = parseFloat($(`#jasaTable input[name="detail_jasa[${row}][harga_satuan]"]`).val());
                const qty = parseFloat($(this).val());
                const discount = parseFloat($(`#jasaTable input[name="detail_jasa[${row}][discount]"]`).val());

                const total = calculateRowTotal(hargaSatuan, qty, discount);

                // Update row total display
                $(`#jasa-row-${row} .row-total`).text(formatRupiah(total));
                $(`#jasaTable input[name="detail_jasa[${row}][jumlah]"]`).val(total);

                // Update the item in the array
                const itemIndex = jasaItems.findIndex(item => item.id === row);
                if (itemIndex !== -1) {
                    jasaItems[itemIndex].qty = qty;
                    jasaItems[itemIndex].jumlah = total;
                }

                updateTotals();
            });

            $(document).on('change', '#jasaTable .discount', function () {
                const row = $(this).data('row');
                const hargaSatuan = parseFloat($(`#jasaTable input[name="detail_jasa[${row}][harga_satuan]"]`).val());
                const qty = parseFloat($(`#jasaTable input[name="detail_jasa[${row}][qty]"]`).val());
                const discount = parseFloat($(this).val());

                const total = calculateRowTotal(hargaSatuan, qty, discount);

                // Update row total display
                $(`#jasa-row-${row} .row-total`).text(formatRupiah(total));
                $(`#jasaTable input[name="detail_jasa[${row}][jumlah]"]`).val(total);

                // Update the item in the array
                const itemIndex = jasaItems.findIndex(item => item.id === row);
                if (itemIndex !== -1) {
                    jasaItems[itemIndex].discount = discount;
                    jasaItems[itemIndex].jumlah = total;
                }

                updateTotals();
            });

            $(document).on('change', '#partTable .qty', function () {
                const row = $(this).data('row');
                const hargaSatuan = parseFloat($(`#partTable input[name="detail_part[${row}][harga_satuan]"]`).val());
                const qty = parseFloat($(this).val());
                const discount = parseFloat($(`#partTable input[name="detail_part[${row}][discount]"]`).val());

                const total = calculateRowTotal(hargaSatuan, qty, discount);

                // Update row total display
                $(`#part-row-${row} .row-total`).text(formatRupiah(total));
                $(`#partTable input[name="detail_part[${row}][jumlah]"]`).val(total);

                // Update the item in the array
                const itemIndex = partItems.findIndex(item => item.id === row);
                if (itemIndex !== -1) {
                    partItems[itemIndex].qty = qty;
                    partItems[itemIndex].jumlah = total;
                }

                updateTotals();
            });

            $(document).on('change', '#partTable .discount', function () {
                const row = $(this).data('row');
                const hargaSatuan = parseFloat($(`#partTable input[name="detail_part[${row}][harga_satuan]"]`).val());
                const qty = parseFloat($(`#partTable input[name="detail_part[${row}][qty]"]`).val());
                const discount = parseFloat($(this).val());

                const total = calculateRowTotal(hargaSatuan, qty, discount);

                // Update row total display
                $(`#part-row-${row} .row-total`).text(formatRupiah(total));
                $(`#partTable input[name="detail_part[${row}][jumlah]"]`).val(total);

                // Update the item in the array
                const itemIndex = partItems.findIndex(item => item.id === row);
                if (itemIndex !== -1) {
                    partItems[itemIndex].discount = discount;
                    partItems[itemIndex].jumlah = total;
                }

                updateTotals();
            });

            $(document).on('click', '.hapus-jasa', function () {
                const row = $(this).data('row');

                // Remove from table
                $(`#jasa-row-${row}`).remove();

                // Remove from array
                const itemIndex = jasaItems.findIndex(item => item.id === row);
                if (itemIndex !== -1) {
                    jasaItems.splice(itemIndex, 1);
                    jasaCounter--;
                }

                updateTotals();
            });

            $(document).on('click', '.hapus-part', function () {
                const row = $(this).data('row');

                // Remove from table
                $(`#part-row-${row}`).remove();

                // Remove from array
                const itemIndex = partItems.findIndex(item => item.id === row);
                if (itemIndex !== -1) {
                    partItems.splice(itemIndex, 1);
                    partCounter--;
                }

                updateTotals();
            });

            $('#filterJasaBerkalaTipe').on('change', function () {
                const selectedTipe = $(this).val();

                if (selectedTipe === '') {
                    // Show all rows
                    $('#jasaBerkalaTable tbody tr').show();
                } else {
                    // Hide all rows first
                    $('#jasaBerkalaTable tbody tr').hide();
                    // Show only rows with matching tipe
                    $(`#jasaBerkalaTable tbody tr[data-tipe="${selectedTipe}"]`).show();
                }
            });

            $('#filterPartTipe').on('change', function () {
                const selectedTipe = $(this).val();

                if (selectedTipe === '') {
                    // Show all rows
                    $('#partListTable tbody tr').show();
                } else {
                    // Hide all rows first
                    $('#partListTable tbody tr').hide();
                    // Show only rows with matching tipe
                    $(`#partListTable tbody tr[data-tipe="${selectedTipe}"]`).show();
                }
            });

            $('#tipe_mobil').on('change', function () {
                const selectedTipe = $(this).val();
                $('#filterJasaBerkalaTipe').val(selectedTipe).trigger('change');
                $('#filterPartTipe').val(selectedTipe).trigger('change');
            });

            $('#estimasiForm').on('submit', function (e) {
                if (jasaItems.length === 0 && partItems.length === 0) {
                    e.preventDefault();
                    alert('Silakan tambahkan minimal satu item jasa atau part.');
                    return false;
                }

                return true;
            });

            $('#btnTambahJasa').on('click', function () {
                const activeTab = $('#jasaTab .nav-link.active').attr('href');

                if (activeTab === '#jasaBerkala') {
                    // Ambil jasa berkala yang dicentang
                    const checkedJasaBerkala = $('#jasaBerkalaTable input[name="jasaBerkala[]"]:checked');

                    if (checkedJasaBerkala.length === 0) {
                        alert('Pilih minimal satu jasa berkala untuk ditambahkan.');
                        return;
                    }

                    checkedJasaBerkala.each(function () {
                        const rowIndex = $(this).val();
                        const row = $('#jasaBerkalaTable').DataTable().row(rowIndex).node();
                        const data = $('#jasaBerkalaTable').DataTable().row(rowIndex).data();

                        // Ambil data dari row
                        const idJasa = $(row).find('td:first').data('id');
                        const namaJasa = $(row).find('td:first').data('nama');
                        const hargaJasa = $(row).find('td:first').data('harga');

                        // Buat object jasa item
                        const jasaItem = {
                            id: jasaCounter,
                            id_ref: idJasa,
                            nama: namaJasa,
                            detail_type: 'jasa_berkala',
                            harga_satuan: hargaJasa,
                            qty: 1,
                            discount: 0,
                            jumlah: hargaJasa,
                            keterangan: ''
                        };

                        // Tambahkan ke array
                        jasaItems.push(jasaItem);

                        // Tambahkan ke tabel
                        addJasaRowToTable(jasaItem);

                        jasaCounter++;
                    });

                    // Uncheck semua checkbox
                    $('#jasaBerkalaTable input[name="jasaBerkala[]"]').prop('checked', false);
                    $('#checkSelectAllJasaBerkala').prop('checked', false);

                } else if (activeTab === '#jasaVendor') {
                    // Ambil jasa vendor yang dicentang
                    const checkedJasaVendor = $('#jasaVendorTable input[name="jasaVendor[]"]:checked');

                    if (checkedJasaVendor.length === 0) {
                        alert('Pilih minimal satu jasa vendor untuk ditambahkan.');
                        return;
                    }

                    checkedJasaVendor.each(function () {
                        const rowIndex = $(this).val();
                        const row = $('#jasaVendorTable').DataTable().row(rowIndex).node();
                        const data = $('#jasaVendorTable').DataTable().row(rowIndex).data();

                        // Ambil data dari row (sesuaikan dengan struktur data jasaVendor)
                        const namaJasa = $(row).find('td:nth-child(3)').text();
                        const hargaJasa = parseFloat($(row).find('td:nth-child(4)').text().replace(/[^\d,-]/g, '').replace(',', '.'));

                        // Buat object jasa item
                        const jasaItem = {
                            id: jasaCounter,
                            id_ref: rowIndex, // atau ID yang sesuai dari data vendor
                            nama: namaJasa,
                            detail_type: 'jasa_vendor',
                            harga_satuan: hargaJasa,
                            qty: 1,
                            discount: 0,
                            jumlah: hargaJasa,
                            keterangan: ''
                        };

                        // Tambahkan ke array
                        jasaItems.push(jasaItem);

                        // Tambahkan ke tabel
                        addJasaRowToTable(jasaItem);

                        jasaCounter++;
                    });

                    // Uncheck semua checkbox
                    $('#jasaVendorTable input[name="jasaVendor[]"]').prop('checked', false);
                    $('#checkSelectAllJasaVendor').prop('checked', false);
                }

                updateTotals();
                $('#jasaModal').modal('hide');
            });

            $('#btnTambahPart').on('click', function () {
                const activeTab = $('#partTab .nav-link.active').attr('href');

                if (activeTab === '#partList') {
                    // Ambil part yang dicentang
                    const checkedParts = $('#partMasterTable input[name="part[]"]:checked');

                    if (checkedParts.length === 0) {
                        alert('Pilih minimal satu part untuk ditambahkan.');
                        return;
                    }

                    checkedParts.each(function () {
                        const rowIndex = $(this).val();
                        const row = $('#partMasterTable').DataTable().row(rowIndex).node();
                        const data = $('#partMasterTable').DataTable().row(rowIndex).data();

                        // Ambil data dari row (sesuaikan dengan struktur data part)
                        const namaPart = $(row).find('td:nth-child(4)').text();
                        const hargaPart = parseFloat($(row).find('td:nth-child(5)').text().replace(/[^\d,-]/g, '').replace(',', '.'));

                        // Buat object part item
                        const partItem = {
                            id: partCounter,
                            id_ref: rowIndex, // atau ID yang sesuai dari data part
                            nama: namaPart,
                            detail_type: 'part',
                            harga_satuan: hargaPart,
                            qty: 1,
                            discount: 0,
                            jumlah: hargaPart,
                            keterangan: ''
                        };

                        // Tambahkan ke array
                        partItems.push(partItem);

                        // Tambahkan ke tabel
                        addPartRowToTable(partItem);

                        partCounter++;
                    });

                    // Uncheck semua checkbox
                    $('#partMasterTable input[name="part[]"]').prop('checked', false);
                    $('#checkSelectAllPart').prop('checked', false);

                } else if (activeTab === '#materialList') {
                    // Ambil material yang dicentang
                    const checkedMaterials = $('#materialTable input[name="material[]"]:checked');

                    if (checkedMaterials.length === 0) {
                        alert('Pilih minimal satu material untuk ditambahkan.');
                        return;
                    }

                    checkedMaterials.each(function () {
                        const rowIndex = $(this).val();
                        const row = $('#materialTable').DataTable().row(rowIndex).node();
                        const data = $('#materialTable').DataTable().row(rowIndex).data();

                        // Ambil data dari row (sesuaikan dengan struktur data material)
                        const namaMaterial = $(row).find('td:nth-child(3)').text();
                        const hargaMaterial = parseFloat($(row).find('td:nth-child(5)').text().replace(/[^\d,-]/g, '').replace(',', '.'));

                        // Buat object material item
                        const materialItem = {
                            id: partCounter,
                            id_ref: rowIndex, // atau ID yang sesuai dari data material
                            nama: namaMaterial,
                            detail_type: 'material',
                            harga_satuan: hargaMaterial,
                            qty: 1,
                            discount: 0,
                            jumlah: hargaMaterial,
                            keterangan: ''
                        };

                        // Tambahkan ke array
                        partItems.push(materialItem);

                        // Tambahkan ke tabel
                        addPartRowToTable(materialItem);

                        partCounter++;
                    });

                    // Uncheck semua checkbox
                    $('#materialTable input[name="material[]"]').prop('checked', false);
                    $('#checkSelectAllMaterial').prop('checked', false);
                }

                updateTotals();
                $('#partModal').modal('hide');
            });

            function addJasaRowToTable(jasaItem) {
                const rowHtml = `
                                                <tr id="jasa-row-${jasaItem.id}">
                                                    <td>${$('#jasaTable tbody tr').length + 1}</td>
                                                    <td>
                                                        ${jasaItem.nama}
                                                        <input type="hidden" name="detail_jasa[${jasaItem.id}][id_ref]" value="${jasaItem.id_ref}">
                                                        <input type="hidden" name="detail_jasa[${jasaItem.id}][nama]" value="${jasaItem.nama}">
                                                        <input type="hidden" name="detail_jasa[${jasaItem.id}][detail_type]" value="${jasaItem.detail_type}">
                                                    </td>
                                                    <td>
                                                        ${formatRupiah(jasaItem.harga_satuan)}
                                                        <input type="hidden" name="detail_jasa[${jasaItem.id}][harga_satuan]" value="${jasaItem.harga_satuan}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="detail_jasa[${jasaItem.id}][qty]" value="${jasaItem.qty}" 
                                                               class="form-control qty" data-row="${jasaItem.id}" min="1" step="any">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="detail_jasa[${jasaItem.id}][discount]" value="${jasaItem.discount}" 
                                                               class="form-control discount" data-row="${jasaItem.id}" min="0" max="100" step="any">
                                                    </td>
                                                    <td>
                                                        <span class="row-total">${formatRupiah(jasaItem.jumlah)}</span>
                                                        <input type="hidden" name="detail_jasa[${jasaItem.id}][jumlah]" value="${jasaItem.jumlah}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="detail_jasa[${jasaItem.id}][keterangan]" value="${jasaItem.keterangan}" 
                                                               class="form-control" placeholder="Keterangan...">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm hapus-jasa" data-row="${jasaItem.id}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            `;

                $('#jasaTable tbody').append(rowHtml);
            }

            function addPartRowToTable(partItem) {
                const rowHtml = `
                                                <tr id="part-row-${partItem.id}">
                                                    <td>${$('#partTable tbody tr').length + 1}</td>
                                                    <td>
                                                        ${partItem.nama}
                                                        <input type="hidden" name="detail_part[${partItem.id}][id_ref]" value="${partItem.id_ref}">
                                                        <input type="hidden" name="detail_part[${partItem.id}][nama]" value="${partItem.nama}">
                                                        <input type="hidden" name="detail_part[${partItem.id}][detail_type]" value="${partItem.detail_type}">
                                                    </td>
                                                    <td>
                                                        ${formatRupiah(partItem.harga_satuan)}
                                                        <input type="hidden" name="detail_part[${partItem.id}][harga_satuan]" value="${partItem.harga_satuan}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="detail_part[${partItem.id}][qty]" value="${partItem.qty}" 
                                                               class="form-control qty" data-row="${partItem.id}" min="1" step="any">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="detail_part[${partItem.id}][discount]" value="${partItem.discount}" 
                                                               class="form-control discount" data-row="${partItem.id}" min="0" max="100" step="any">
                                                    </td>
                                                    <td>
                                                        <span class="row-total">${formatRupiah(partItem.jumlah)}</span>
                                                        <input type="hidden" name="detail_part[${partItem.id}][jumlah]" value="${partItem.jumlah}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="detail_part[${partItem.id}][keterangan]" value="${partItem.keterangan}" 
                                                               class="form-control" placeholder="Keterangan...">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm hapus-part" data-row="${partItem.id}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            `;

                $('#partTable tbody').append(rowHtml);
            }

            function searchJasaBerkala() {
                jasaBerkalaTable.columns(2).search($('#tipe_mobil_filter').val());
                jasaBerkalaTable.columns(3).search($('jenis_service_filter').val());
                jasaBerkalaTable.columns(4).search($('biaya_jasa_filter').val());
                jasaBerkalaTable.draw();
            }
            function searchJasaVendor() {
                jasaVendorTable.columns(2).search($('jasa_vendor_filter').val());
                jasaVendorTable.columns(3).search($('harga_jasa_filter').val());
                jasaVendorTable.draw()
            }
            function searchPart() {
                partMasterTable.columns(2).search($('part_tipe_filter').val());
                partMasterTable.columns(3).search($('part_nama_filter').val());
                partMasterTable.columns(4).search($('part_harga_filter').val());
                partMasterTable.draw();
            }
            function searchMaterial() {
                materialTable.columns(2).search($('material_nama_filter').val());
                materialTable.columns(3).search($('material_jenis_filter').val());
                materialTable.columns(4).search($('material_harga_filter').val());
                materialTable.draw();
            }
        });
    </script>
@endpush