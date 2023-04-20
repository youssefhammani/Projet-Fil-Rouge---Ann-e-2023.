@extends('layouts.master')

{{-- @section('title', 'View Users') --}}

@section('content')
    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-header">
                <h4>View Users</h4>
            </div>
            <div class="card-body">

                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>created_at</th>
                            {{-- <th>Modify permission</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('uploads/category/' . $item->image) }}" alt=""
                                            style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{ $item->name }}</p>
                                            <p class="text-muted mb-0">{{ $item->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td>
                          <p class="fw-normal mb-1">Software engineer</p>
                          <p class="text-muted mb-0">IT department</p>
                        </td> --}}
                                <td>
                                    <span
                                        class="badge bg-success rounded-pill d-inline px-3">{{ $item->role == 'admin' ? 'Admin' : 'User' }}</span>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
