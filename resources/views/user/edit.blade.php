@extends('layouts.admin')

@section('title', 'Update User')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Information</h5>
                    </div>
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="image">
                                            <img src={{ $user->profileimg === null ? '/adminLTE/dist/img/personplaceholder.png' : $user->profileimg }}
                                                id="profile" class="img-circle elevation-2 border border-secondary"
                                                style="width:128px;height:128px" alt="User Image" />
                                        </div>
                                        <input type="file" name="profileimg"
                                            onchange="document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])"
                                            accept="image/*" class="form-control-file mt-4">
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
                                        <input required type="text" value="{{ $user->name }}" name="name"
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
                                            <option {{ $user->gender === 'Male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option {{ $user->gender === 'Female' ? 'selected' : '' }}>
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
                                        <input required type="text" value="{{ $user->email }}" name="email"
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
                        <h5>Update Access Level</h5>
                    </div>
                    <form method="POST" action="{{ route('users.updateAccessLevel', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="access_level">Access level</label>
                                        <select required name="access_level" id="access_level" class="form-control">
                                            <option value="">Select</option>
                                            <option {{ $user->access_level === 'Admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option {{ $user->access_level === 'Supervisor' ? 'selected' : '' }}>
                                                Supervisor</option>
                                            <option {{ $user->access_level === 'User' ? 'selected' : '' }}>
                                                User</option>
                                        </select>
                                        @error('access_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Promote/Demote</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
