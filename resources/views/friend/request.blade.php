@extends('layouts.admin')

@section('title', 'Friend Requests')
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
                                        <th>Date Requested</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($friendRequests as $friendRequest)
                                        <tr>
                                            <td>
                                                <img src={{ $friendRequest->sender->profileimg === null ? '/adminLTE/dist/img/personplaceholder.png' : $friendRequest->sender->profileimg }}
                                                    class="img-circle elevation-2 border border-secondary"
                                                    style="width:64px;height:64px" alt="FriendRequest Image" />
                                            </td>
                                            <td>{{ $friendRequest->sender->name }}</td>
                                            <td>{{ $friendRequest->sender->gender }}</td>
                                            <td>{{ $friendRequest->sender->email }}</td>
                                            <td>{{ $friendRequest->sender->access_level }}</td>
                                            <td>{{ \Carbon\Carbon::parse($friendRequest->created_at)->diffForHumans() }}
                                            </td>
                                            <td>
                                                <form id="accept-form{{ $friendRequest->sender->id }}" class="text-center"
                                                    method="POST"
                                                    action="{{ route('friendRequests.acceptRequest', $friendRequest->sender->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="confirmAction(event,'accept-form{{ $friendRequest->sender->id }}')"
                                                        class="btn btn-block m-2 btn-primary">Accept Request</button>
                                                </form>
                                                <form id="deny-form{{ $friendRequest->id }}" class="text-center"
                                                    method="POST"
                                                    action="{{ route('friendRequests.denyRequest', $friendRequest->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="confirmAction(event,'deny-form{{ $friendRequest->id }}')"
                                                        class="btn btn-block m-2 btn-danger">Deny Request</button>
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
