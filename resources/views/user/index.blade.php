@extends('layouts.admin')

@section('title', 'Manage Users')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Fullname</th>
                                        <th>Gender</th>
                                        <th>Email Address</th>
                                        <th>Access Level</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <img src={{ $user->profileimg === null ? '/AdminLTE/dist/img/personplaceholder.png' : $user->profileimg }}
                                                    class="img-circle elevation-2 border border-secondary"
                                                    style="width:64px;height:64px" alt="User Image" />
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->access_level }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>

                                            <td>
                                                <form id="delete-form{{ $user->id }}" method="POST"
                                                    action="{{ route('users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-block btn-info">Update</a>
                                                    <button type="submit"
                                                        onclick="confirmAction(event,'delete-form{{ $user->id }}')"
                                                        class="btn btn-block btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
