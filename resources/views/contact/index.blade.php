@extends('layouts.admin')

@section('title', 'My Contact List')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href={{ route('contacts.create') }} class="btn btn-primary">Add Contact</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>

                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->company }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}</td>
                                            <td>
                                                <form id="delete-form{{ $contact->id }}" method="POST"
                                                    action="{{ route('contacts.destroy', $contact->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('contacts.shareContact', $contact->id) }}"
                                                        class="btn btn-block btn-warning">Share</a>
                                                    <a href="{{ route('contacts.edit', $contact->id) }}"
                                                        class="btn btn-block btn-info">Update</a>
                                                    <button type="submit"
                                                        onclick="confirmAction(event,'delete-form{{ $contact->id }}')"
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Shared Contacts <small>(Contacts that my friends shared to me)</small></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Shared By</th>
                                        <th>Date Shared</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shared_contacts as $shared_contact)
                                        <tr>
                                            <td>{{ $shared_contact->contact->name }}</td>
                                            <td>{{ $shared_contact->contact->phone }}</td>
                                            <td>{{ $shared_contact->contact->email }}</td>
                                            <td>{{ $shared_contact->contact->company }}</td>
                                            <td>{{ $shared_contact->contact->user->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($shared_contact->created_at)->diffForHumans() }}
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
