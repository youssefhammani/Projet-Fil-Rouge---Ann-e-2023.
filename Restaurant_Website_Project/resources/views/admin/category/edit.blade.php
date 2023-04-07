@extends('layouts.master')

@section('title', 'Category')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Edit Category</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="aladdert alert-danger">
                    @foreach ($errors->all(); as $error)
                       <div>{{ $error }}</div> 
                    @endforeach
                </div>
                
            @endif

            <form action="{{ url('admin/update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection