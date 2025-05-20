@extends('shared.general.layouts')
@section('content')
    <div class="row">
        <div class=" col-md-12 col-sm-12 mt-3">
            <div class="x_panel" style="height: fit-content;">
                <div class="x_title">
                    <h2>Perbarui Data Jasa Vendor<small>({{ $jasavendor->jasa }})</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{ route('jasavendors.update', $jasavendor->id_jasa) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="id_jasa" name="id_jasa" value="{{ $jasavendor->id_jasa }}"
                            class="form-control" readonly>

                        <div class="col-sm-4 mb-2">
                            Nama Service<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="text" id="jasa" name="jasa" required="required"
                                        value="{{ $jasavendor->jasa }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            Harga<span style="color: red;"> *</span>
                            <div class="form-group">
                                <div class="item form-group">
                                    <input type="number" id="harga" name="harga" required="required"
                                        value="{{ $jasavendor->harga }}" class="form-control">
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
            // Reset form to original values
            $('#form').reset();
        }
    </script>
@endpush