@extends('shared.general.layouts')
@section('content')
    <div class="row">
        <div class=" col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Tambah Data Material</h2>
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
                    <form action="{{ route('materials.store') }}" method="POST" id="form">
                        @csrf
                        <input type="hidden" id="id_material" name="id_material" class="form-control"
                            value="{{ old('id_material') }}" required>

                        <div class="col-sm-4 mb-2">
                            No. Material<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="no_material" name="no_material" class="form-control"
                                        value="{{ old('no_material') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Nama Material<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="nama_material" name="nama_material" class="form-control"
                                        value="{{ old('nama_material') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Tipe Material<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <select class="form-control" id="jenis_material" name="jenis_material" required>
                                        <option value="" disabled selected>Pilih Tipe Material</option>
                                        <option value="MATERIAL" {{ old('jenis_material') == 'MATERIAL' ? 'selected' : '' }}>
                                            MATERIAL</option>
                                        <option value="ITEM TAMBAHAN" {{ old('jenis_material') == 'ITEM TAMBAHAN' ? 'selected' : '' }}>ITEM TAMBAHAN</option>
                                        <option value="BOHLAM" {{ old('jenis_material') == 'BOHLAM' ? 'selected' : '' }}>
                                            BOHLAM</option>
                                        <option value="OLI MESIN" {{ old('jenis_material') == 'OLI MESIN' ? 'selected' : '' }}>OLI MESIN</option>
                                        <option value="LAINNYA" {{ old('jenis_material') == 'LAINNYA' ? 'selected' : '' }}>
                                            LAINNYA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Harga<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="number" id="harga_satuan" name="harga_satuan" class="form-control"
                                        value="{{ old('harga_satuan', 0) }}" step="1" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4">
                            <a href="{{ route('materials.index') }}"
                                class="btn btn-outline-secondary btn-back btn-sm">Kembali</a>
                            <a href="javascript:void(0);" onclick="reset()"
                                class="btn btn-secondary btn-back btn-sm">Reset</a>
                            @if (session('role') === 'Service Advisor 1' || session('role') === 'Service Advisor 2' || session('role') === 'Service Advisor 3')
                                <button type="submit" class="btn btn-primary btn-submit btn-sm">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#no_material').on('change', function () {
                var noMaterial = $('#no_material').val();
                $('#id_material').val(noMaterial);
            });
        });

        function reset() {
            $('#form').reset();
        }
    </script>
@endpush