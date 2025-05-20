@extends('shared.general.layouts')
@section('content')
    <div class="row">
        <div class=" col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Perbarui Data Material<small>({{ $material->nama_material }})</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{ route('materials.update', $material->no_material) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="id_material" name="id_material" value="{{ $material->id_material }}"
                            class="form-control" readonly>

                        <div class="col-sm-4 mb-2">
                            No. Material<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="no_material" name="no_material"
                                        value="{{ $material->no_material }}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Nama Material<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="nama_material" name="nama_material"
                                        value="{{ $material->nama_material }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Tipe Material<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="jenis_material" name="jenis_material"
                                        value="{{ $material->jenis_material }}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Harga<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="number" id="harga_satuan" name="harga_satuan" required="required"
                                        value="{{ $material->harga_satuan }}" class="form-control">
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
            // Any specific JavaScript for this page can go here
        });

        function reset() {
            $('#form').reset();
        }
    </script>
@endpush