@extends('shared.general.layouts')
@section('content')
    <div class="row">
        <div class=" col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Tambah Data Jasa Berkala</h2>
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
                    <form action="{{ route('jasaberkalas.store') }}" method="POST" id="form">
                        @csrf

                        <input type="hidden" id="id_jasa" name="id_jasa" class="form-control"
                            value="{{ $autoId ?? old('id_jasa') }}" required>

                        <div class="col-sm-4 mb-2">
                            Tipe Mobil<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <select id="tipe_mobil" name="tipe_mobil" class="form-control" required>
                                        <option value="" disabled selected>Pilih Tipe Mobil</option>
                                        <option value="Daihatsu Sigra" {{ old('tipe_mobil') == 'Daihatsu Sigra' ? 'selected' : '' }}>Daihatsu Sigra</option>
                                        <option value="Daihatsu Xenia" {{ old('tipe_mobil') == 'Daihatsu Xenia' ? 'selected' : '' }}>Daihatsu Xenia</option>
                                        <option value="Daihatsu Ayla" {{ old('tipe_mobil') == 'Daihatsu Ayla' ? 'selected' : '' }}>Daihatsu Ayla</option>
                                        <option value="Daihatsu Sirion" {{ old('tipe_mobil') == 'Daihatsu Sirion' ? 'selected' : '' }}>Daihatsu Sirion</option>
                                        <option value="Daihatsu Granmax" {{ old('tipe_mobil') == 'Daihatsu Granmax' ? 'selected' : '' }}>Daihatsu Granmax</option>
                                        <option value="Daihatsu Luxio" {{ old('tipe_mobil') == 'Daihatsu Luxio' ? 'selected' : '' }}>Daihatsu Luxio</option>
                                        <option value="Daihatsu Rocky" {{ old('tipe_mobil') == 'Daihatsu Rocky' ? 'selected' : '' }}>Daihatsu Rocky</option>
                                        <option value="Daihatsu Terios Old" {{ old('tipe_mobil') == 'Daihatsu Terios Old' ? 'selected' : '' }}>Daihatsu Terios Old</option>
                                        <option value="Daihatsu Terios All New" {{ old('tipe_mobil') == 'Daihatsu Terios All New' ? 'selected' : '' }}>Daihatsu Terios All New</option>
                                        <option value="LAINNYA" {{ old('tipe_mobil') == 'LAINNYA' ? 'selected' : '' }}>LAINNYA
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Jenis Service<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <select id="jenis_service" name="jenis_service" class="form-control" required>
                                        <option value="" disabled selected>Pilih Jenis Service</option>
                                        <option value="Jasa Service 10.000 Km" {{ old('jenis_service') == 'Jasa Service 10.000 Km' ? 'selected' : '' }}>Jasa Service 10.000 Km</option>
                                        <option value="Jasa Service 20.000 Km" {{ old('jenis_service') == 'Jasa Service 20.000 Km' ? 'selected' : '' }}>Jasa Service 20.000 Km</option>
                                        <option value="Jasa Service 30.000 Km" {{ old('jenis_service') == 'Jasa Service 30.000 Km' ? 'selected' : '' }}>Jasa Service 30.000 Km</option>
                                        <option value="Jasa Service 40.000 Km" {{ old('jenis_service') == 'Jasa Service 40.000 Km' ? 'selected' : '' }}>Jasa Service 40.000 Km</option>
                                        <option value="Jasa Service 50.000 Km" {{ old('jenis_service') == 'Jasa Service 50.000 Km' ? 'selected' : '' }}>Jasa Service 50.000 Km</option>
                                        <option value="Jasa Service 60.000 Km" {{ old('jenis_service') == 'Jasa Service 60.000 Km' ? 'selected' : '' }}>Jasa Service 60.000 Km</option>
                                        <option value="Jasa Service 70.000 Km" {{ old('jenis_service') == 'Jasa Service 70.000 Km' ? 'selected' : '' }}>Jasa Service 70.000 Km</option>
                                        <option value="Jasa Service 80.000 Km" {{ old('jenis_service') == 'Jasa Service 80.000 Km' ? 'selected' : '' }}>Jasa Service 80.000 Km</option>
                                        <option value="Jasa Service 90.000 Km" {{ old('jenis_service') == 'Jasa Service 90.000 Km' ? 'selected' : '' }}>Jasa Service 90.000 Km</option>
                                        <option value="Jasa Service 100.000 Km" {{ old('jenis_service') == 'Jasa Service 100.000 Km' ? 'selected' : '' }}>Jasa Service 100.000 Km</option>
                                        <option value="Jasa Service Kelipatan 5000 Km" {{ old('jenis_service') == 'Jasa Service Kelipatan 5000 Km' ? 'selected' : '' }}>Jasa Service Kelipatan 5000 Km
                                        </option>
                                        <option value="Jasa Service Ganti Oli" {{ old('jenis_service') == 'Jasa Service Ganti Oli' ? 'selected' : '' }}>Jasa Service Ganti Oli</option>
                                        <option value="Jasa Service Ganti Oli Lengkap" {{ old('jenis_service') == 'Jasa Service Ganti Oli Lengkap' ? 'selected' : '' }}>Jasa Service Ganti Oli Lengkap
                                        </option>
                                        <option value="Jasa Service Ganti Oli + Of" {{ old('jenis_service') == 'Jasa Service Ganti Oli + Of' ? 'selected' : '' }}>Jasa Service Ganti Oli + Of</option>
                                        <option value="Jasa Service Ganti Oli Lengkap + Of" {{ old('jenis_service') == 'Jasa Service Ganti Oli Lengkap + Of' ? 'selected' : '' }}>Jasa Service Ganti Oli
                                            Lengkap + Of</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Biaya Jasa<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="number" id="biaya_jasa" name="biaya_jasa" class="form-control"
                                        value="{{ old('biaya_jasa', 0) }}" step="1" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4">
                            <a href="{{ route('jasaberkalas.index') }}"
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
            $('#id_jasa').val('{{ $autoId ?? '' }}');
        }
    </script>
@endpush