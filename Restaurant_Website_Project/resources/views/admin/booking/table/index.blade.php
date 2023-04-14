@extends('layouts.master')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>All Tables
                <a href="{{ url('/book-a-table') }}" class="btn btn-primary btn-sm float-end">Add Table</a>
            </h4>
        </div>
        <div class="card-body">
            
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Number of People</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                    <tr>
                        <td>{{ $table->id }}</td>
                        <td>{{ $table->name }}</td>
                        <td>{{ $table->email }}</td>
                        <td>{{ $table->phone }}</td>
                        <td>{{ $table->date }}</td>
                        <td>{{ $table->time }}</td>
                        <td>{{ $table->num_of_people }}</td>
                        <td>{{ $table->message }}</td>
                        <td>
                            <a href="{{ route('booking.Edit', $table->id) }}" class="btn btn-outline-primary">Edit</a>
                            <a href="{{ route('booking.Delete', $table->id) }}" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
