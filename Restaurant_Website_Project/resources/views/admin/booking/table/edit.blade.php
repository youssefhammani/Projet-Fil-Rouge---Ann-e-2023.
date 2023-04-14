@extends('layouts.master')

@section('title', 'Edit Reservation')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Edit Reservation
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
    
            <form action="{{ route('booking.Update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $reservation->name }}" >
                </div>
    
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $reservation->email }}" >
                </div>
    
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ $reservation->phone }}" >
                </div>
    
                <div class="mb-3">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $reservation->date }}" >
                </div>
    
                <div class="mb-3">
                    <label for="time">Time</label>
                    <input type="time" name="time" id="time" class="form-control" value="{{ $reservation->time }}" >
                </div>
    
                <div class="mb-3">
                    <label for="num_of_people">Number of People</label>
                    <input type="number" name="num_of_people" id="num_of_people" class="form-control" min="0" value="{{ $reservation->num_of_people }}" >
                </div>
    
                <div class="mb-3">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" rows="3">{{ $reservation->message }}</textarea>
                </div>
    
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Update Reservation</button>
                </div>
    
            </form>
    
        </div>
    </div>
</div>
@endsection    