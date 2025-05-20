@extends('shared.general.layouts')
@section('content')
    <div class="row">
        <div class=" col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Tambah Data Part</h2>
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
                    <form action="{{ route('parts.store') }}" method="POST" id="form">
                        @csrf

                        <input type="hidden" id="id_part" name="id_part" class="form-control" value="{{ old('id_part') }}"
                            required>

                        <div class="col-sm-4 mb-2">
                            No. Part<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="no_part" name="no_part" class="form-control"
                                        value="{{ old('no_part') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Nama Part<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="nama_part" name="nama_part" class="form-control"
                                        value="{{ old('nama_part') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Tipe Mobil<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <select class="form-control" id="tipe_mobil" name="tipe_mobil" required>
                                        <option value="" disabled selected>Pilih Tipe Mobil</option>
                                        <option value="TERIOS M/T" {{ old('tipe_mobil') == 'TERIOS M/T' ? 'selected' : '' }}>
                                            TERIOS M/T</option>
                                        <option value="TERIOS A/T" {{ old('tipe_mobil') == 'TERIOS A/T' ? 'selected' : '' }}>
                                            TERIOS A/T</option>
                                        <option value="GRANMAX 1.3" {{ old('tipe_mobil') == 'GRANMAX 1.3' ? 'selected' : '' }}>GRANMAX 1.3</option>
                                        <option value="GRANMAX 1.5" {{ old('tipe_mobil') == 'GRANMAX 1.5' ? 'selected' : '' }}>GRANMAX 1.5</option>
                                        <option value="XENIA 1.0" {{ old('tipe_mobil') == 'XENIA 1.0' ? 'selected' : '' }}>
                                            XENIA 1.0</option>
                                        <option value="XENIA 1.3" {{ old('tipe_mobil') == 'XENIA 1.3' ? 'selected' : '' }}>
                                            XENIA 1.3</option>
                                        <option value="SIRION M/T" {{ old('tipe_mobil') == 'SIRION M/T' ? 'selected' : '' }}>
                                            SIRION M/T</option>
                                        <option value="SIRION A/T" {{ old('tipe_mobil') == 'SIRION A/T' ? 'selected' : '' }}>
                                            SIRION A/T</option>
                                        <option value="TARUNA 1.5" {{ old('tipe_mobil') == 'TARUNA 1.5' ? 'selected' : '' }}>
                                            TARUNA 1.5</option>
                                        <option value="TARUNA 1.6" {{ old('tipe_mobil') == 'TARUNA 1.6' ? 'selected' : '' }}>
                                            TARUNA 1.6</option>
                                        <option value="ZEBRA 1.3" {{ old('tipe_mobil') == 'ZEBRA 1.3' ? 'selected' : '' }}>
                                            ZEBRA 1.3</option>
                                        <option value="ZEBRA 1.5" {{ old('tipe_mobil') == 'ZEBRA 1.5' ? 'selected' : '' }}>
                                            ZEBRA 1.5</option>
                                        <option value="CERIA" {{ old('tipe_mobil') == 'CERIA' ? 'selected' : '' }}>CERIA
                                        </option>
                                        <option value="TAFT" {{ old('tipe_mobil') == 'TAFT' ? 'selected' : '' }}>TAFT</option>
                                        <option value="LAINNYA" {{ old('tipe_mobil') == 'LAINNYA' ? 'selected' : '' }}>LAINNYA
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Harga<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="number" id="harga_part" name="harga_part" class="form-control"
                                        value="{{ old('harga_part', 0) }}" step="1" min="0" required>
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
            $('#no_part').on('change', function () {
                var noPart = $('#no_part').val();
                $('#id_part').val(noPart);
            });
        });

        function reset() {
            $('#form').reset();
        }
    </script>
@endpush