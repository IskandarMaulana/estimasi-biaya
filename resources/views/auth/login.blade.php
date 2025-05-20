@extends('shared.auth.layouts')

@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form"
            style="background-color:white; padding: 30px; margin-top:-29px; width: 450px; border-radius: 20px; margin-left:-20px;text-align: center;">
            <img src="{{ asset('assets/img/daihatsu_logo_2.png') }}" style="width:220px; margin-left:10px;">
            <!-- <img src="{{ asset('assets/img/icare_logo.png') }}" style="width:125px; margin-left: 20px;" /> -->
            <section class="login_content">
                <form action="{{ route('login.post') }}" method="post">
                    @csrf
                    <h1 style="font-weight: bold;">Login Form</h1>
                    <div>
                        <input type="text"
                            class="form-control @error('username')is-invalid @enderror @error('login_error')is-invalid @enderror"
                            id="username" name="username" placeholder="Enter Username" value="{{ old('username') }}"
                            style="margin-bottom: 15px !important;" />
                        @error('username')
                            <span class="invalid-feedback" role="alert" style="margin-bottom: 20px;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('login_error')
                            <span class="invalid-feedback" role="alert" style="margin-bottom: 20px;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div>
                        <input type="password"
                            class="form-control @error('password')is-invalid @enderror @error('login_error')is-invalid @enderror"
                            id="password" name="password" placeholder="Enter Password"
                            style="margin-bottom: 15px !important;" />
                        @error('password')
                            <span class="invalid-feedback" role="alert" style="margin-bottom: 20px;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('login_error')
                            <span class="invalid-feedback" role="alert" style="margin-bottom: 20px;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div>
                        <button type="submit" style="background-color: #B6010A; color: white; border: none; width: 110px;"
                            class="btn btn-default submit">Log in</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1 style="font-size:24px; font-weight: bold;">Service Cost Estimate</h1>
                            <p style="margin-top:-25px; font-size: 16px">PT. Astra Daihatsu Motor</p>
                        </div>
                        <p></p>
                        <p style="font-size: 12px; padding-top: 40px">©2025 All Rights Reserved<br>Developed by :
                            Assembly
                            Plant & Astra Polytechnic</p>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection