@extends('layouts.admin')

@section('title', 'My Friends')
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
                                        <th>Date Added</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($friends as $friend)
                                        <tr>
                                            <td>
                                                <img src={{ $friend->friend->profileimg === null ? '/adminLTE/dist/img/personplaceholder.png' : $friend->friend->profileimg }}
                                                    class="img-circle elevation-2 border border-secondary"
                                                    style="width:64px;height:64px" alt="Friend Image" />
                                            </td>
                                            <td>{{ $friend->friend->name }}</td>
                                            <td>{{ $friend->friend->gender }}</td>
                                            <td>{{ $friend->friend->email }}</td>
                                            <td>{{ $friend->friend->access_level }}</td>
                                            <td>{{ \Carbon\Carbon::parse($friend->created_at)->diffForHumans() }}</td>

                                            {{-- <td>
                                                <form id="delete-form" method="POST"
                                                    action="{{ route('friends.destroy', $friend->friend->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('friends.edit', $friend->friend->id) }}"
                                                        class="btn btn-block btn-info">Update</a>
                                                    <button type="submit"
                                                        onclick="if(confirm('Are you sure?')){ document.getElementById('delete-form').submit();} else{ return false; }"
                                                        class="btn btn-block btn-danger">Delete</button>
                                                </form>
                                            </td> --}}
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
