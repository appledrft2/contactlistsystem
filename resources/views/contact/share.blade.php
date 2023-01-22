@extends('layouts.admin')

@section('title', 'Share Contact')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Select Friends <small>(Please select one or more friends)</small></h5>
                    </div>
                    <form method="POST" action="{{ route('contacts.shareContactStore', $contact_id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="position: relative;right:20px">
                                        <div class="form-group d-flex justify-content-end">
                                            <label for="checkboxPrimary2" class="mt-1 mr-2">SELECT ALL</label>
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="checkboxPrimary2" onchange="checkAllFriends()"
                                                    value="">
                                                <label for="checkboxPrimary2">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="list-group">
                                            @foreach ($friends as $friend)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <div class="ms-2 me-auto mt-1">
                                                        <div class="d-inline">
                                                            <img src={{ $friend->friend->profileimg === null ? '/adminLTE/dist/img/personplaceholder.png' : $friend->friend->profileimg }}
                                                                id="profile"
                                                                class="img-circle elevation-2 border border-secondary"
                                                                style="width:64px;height:64px" alt="User Image" />
                                                            <span class="ml-2">{{ $friend->friend->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="icheck-primary d-inline mt-4">
                                                        <input type="checkbox" name="friends[]"
                                                            id="checkboxPrimary{{ $friend->friend->id }}"
                                                            value="{{ $friend->friend->id }}">
                                                        <label for="checkboxPrimary{{ $friend->friend->id }}">
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </div>
                                        @error('friends')
                                            <span>
                                                <br>
                                                Please select atleast one friend.
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Share Contact</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
