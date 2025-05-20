@extends('shared.general.layouts')
@section('content')
    <div class="row">
        <div class=" col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Tambah Data Jasa Vendor</h2>
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
                    <form action="{{ route('jasavendors.store') }}" method="POST" id="form">
                        @csrf

                        <input type="hidden" id="id_jasa" name="id_jasa" class="form-control"
                            value="{{ $autoId ?? old('id_jasa') }}" required>

                        <div class="col-sm-4 mb-2">
                            Nama Jasa<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="jasa" name="jasa" class="form-control"
                                        value="{{ old('jasa') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Harga<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="number" id="harga" name="harga" class="form-control"
                                        value="{{ old('harga', 0) }}" step="1" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-4">
                            <a href="{{ route('jasavendors.index') }}" 
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