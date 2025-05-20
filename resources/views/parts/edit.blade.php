@extends('shared.general.layouts')
@section('content')

    <div class="row">
        <div class=" col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Perbarui Data Part<small>({{ $part->nama_part }})</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{ route('parts.update', $part->id_part) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="id_part" name="id_part" value="{{ $part->id_part }}" class="form-control">

                        <div class="col-sm-4 mb-2">
                            No. Part
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="no_part" name="no_part" value="{{ $part->no_part }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Nama Part<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="nama_part" name="nama_part" value="{{ $part->nama_part }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Tipe Mobil
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="tipe_mobil" name="tipe_mobil" value="{{ $part->tipe_mobil }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Harga<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="number" id="harga_part" name="harga_part" value="{{ $part->harga_part }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4">
                            <a href="{{ route('parts.index') }}"
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

        });

        function reset() {
            $('#form').reset();
        }
    </script>
@endpush