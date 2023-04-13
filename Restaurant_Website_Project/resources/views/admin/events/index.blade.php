@extends('layouts.master')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4>All Events
                <a href="{{ route('create') }}" class="btn btn-primary btn-sm float-end">Add Event</a>
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
                        <th>Event added by</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Number of People</th>
                        <th>image</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->event_time }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->price }}</td>
                        <td>{{ $event->num_of_people }}</td>
                        <td><img src="{{ asset('uploads/images/event/'.$event->event_image) }}" alt="{{ $event->title }}" height="50"></td>
                        {{-- <td>{{ $event->location }}</td> --}}
                        <td>
                            <a href="{{ route('edit', ['id' => $event->id]) }}" class="btn btn-outline-primary">Edit</a>
                            <a href="{{ route('delete', $event->id) }}" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 
