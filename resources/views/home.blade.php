@extends('layouts.admin')

@section('title', 'My Profile')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Information</h5>
                    </div>
                    <form method="POST" action="{{ route('profile.update', Auth::user()->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="image">
                                            <img src={{ Auth::user()->profileimg === null ? '/adminLTE/dist/img/personplaceholder.png' : Auth::user()->profileimg }}
                                                class="img-circle elevation-2 border border-secondary"
                                                style="width:128px;height:128px" alt="User Image" id="profile" />
                                        </div>
                                        <input type="file" name="profileimg" accept="image/*"
                                            onchange="document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])"
                                            class="form-control-file
                                            mt-4">
                                    </div>
                                    @error('profileimg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="name">Fullname</label>
                                        <input required type="text" value="{{ Auth::user()->name }}" name="name"
                                            id="name" class="form-control">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select required name="gender" id="gender" class="form-control">
                                            <option value="">Select</option>
                                            <option {{ Auth::user()->gender === 'Male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option {{ Auth::user()->gender === 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input required type="text" value="{{ Auth::user()->email }}" name="email"
                                            id="email" class="form-control">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Password</h5>
                    </div>

                    <form method="POST" action="{{ route('profile.updatePassword', Auth::user()->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input id="password" type="password" placeholder="New Password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="false">
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <p>Passwords do not match</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input id="password-confirm" placeholder="Confirm Password" type="password"
                                            class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
