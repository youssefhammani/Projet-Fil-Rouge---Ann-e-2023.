@extends('layouts.master')

@section('title', 'Edit Event')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Edit Event
                <a href="{{ route('index') }}" class="btn btn-primary btn-sm float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                       <div>{{ $error }}</div> 
                    @endforeach
                </div>
                
            @endif

            <form action="{{ route('update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title">Event Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" >
                </div>

                <div class="mb-3">
                    <label for="description">Event Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ $event->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="event_time">Event Time</label>
                    <input type="datetime-local" name="event_time" id="event_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->event_time)) }}" >
                </div>

                <div class="mb-3">
                    <label for="start_time">Event Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->start_time)) }}" >
                </div>

                <div class="mb-3">
                    <label for="end_time">Event End Time</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->end_time)) }}" >
                </div>

                <div class="mb-3">
                    <label for="num_of_people">Number of People</label>
                    <input type="number" name="num_of_people" id="num_of_people" class="form-control" min="0" value="{{ $event->num_of_people }}" >
                </div>

                <div class="mb-3">
                    <label for="event_image">Event Image</label>
                    <input type="file" name="event_image" id="event_image" class="form-control" >
                </div>

                <div class="mb-3">
                    <label for="price">Event Price</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="{{ $event->price }}" >
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Update Event</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
