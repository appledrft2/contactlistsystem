@extends('layouts.admin')

@section('title', 'Find Friends')
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notfriends as $notfriend)
                                        <tr>
                                            <td>
                                                <img src={{ $notfriend->profileimg === null ? '/AdminLTE/dist/img/personplaceholder.png' : $notfriend->profileimg }}
                                                    class="img-circle elevation-2 border border-secondary"
                                                    style="width:64px;height:64px" alt="Notfriend Image" />
                                            </td>
                                            <td>{{ $notfriend->name }}</td>
                                            <td>{{ $notfriend->gender }}</td>
                                            <td>{{ $notfriend->email }}</td>
                                            <td>{{ $notfriend->access_level }}</td>

                                            <td>
                                                <form id="invite-form{{ $notfriend->id }}" class="text-center"
                                                    method="POST"
                                                    action="{{ route('friends.inviteFriend', $notfriend->id) }}">
                                                    @csrf
                                                    <button type="button"
                                                        onclick="confirmAction(event,'invite-form{{ $notfriend->id }}')"
                                                        class="btn btn-primary">Invite
                                                        Friend</button>
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

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Invited Friends</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Fullname</th>
                                        <th>Gender</th>
                                        <th>Email Address</th>
                                        <th>Access Level</th>
                                        <th>Status</th>
                                        <th>Date Invited</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invitedfriends as $invitedfriends)
                                        <tr>
                                            <td>
                                                <img src={{ $invitedfriends->receiver->profileimg === null ? '/AdminLTE/dist/img/personplaceholder.png' : $invitedfriends->receiver->profileimg }}
                                                    class="img-circle elevation-2 border border-secondary"
                                                    style="width:64px;height:64px" alt="Invitedfriends Image" />
                                            </td>
                                            <td>{{ $invitedfriends->receiver->name }}</td>
                                            <td>{{ $invitedfriends->receiver->gender }}</td>
                                            <td>{{ $invitedfriends->receiver->email }}</td>
                                            <td>{{ $invitedfriends->receiver->access_level }}</td>
                                            <td>{{ $invitedfriends->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($invitedfriends->created_at)->diffForHumans() }}
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
