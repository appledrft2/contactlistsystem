@extends('layouts.auth')

@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign up to create your account</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group mb-3">
                <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <select required id="gender" type="text" placeholder="Gender"
                    class="form-control @error('gender') is-invalid @enderror" name="gender" autocomplete="gender"
                    autofocus>
                    <option value="">Select Gender</option>
                    <option {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                    <option {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                </select>

                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="email" type="email" placeholder="Email Address"
                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" placeholder="Password"
                    class="form-control @error('password') is-invalid @enderror" name="password" required
                    autocomplete="false">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">

                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control"
                    name="password_confirmation" required autocomplete="new-password">

            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </div>
                <div class="col-12 mt-2">
                    <a href="/login" class="btn btn-secondary btn-block">Go to Login</a>
                </div>
                <!-- /.col -->
            </div>
        </form>


    </div>
@endsection
