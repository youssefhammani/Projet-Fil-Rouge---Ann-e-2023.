@extends('layouts.master')

@section('title', 'Category')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Add Category
                <a href="{{ url('admin/categories') }}" class="btn btn-primary btn-sm float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all(); as $error)
                       <div>{{ $error }}</div> 
                    @endforeach
                </div>
                
            @endif

            <form action="{{ url('admin/categories') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection