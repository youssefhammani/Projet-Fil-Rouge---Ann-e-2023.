@extends('layouts.master')

@section('title', 'Category')

@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Add Product
                <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm float-end">Back</a>
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

            <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" >
                </div>

                <div class="mb-3">
                    <label for="description">Product Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" ></textarea>
                </div>

                <div class="mb-3">
                    <label for="price">Product Price</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" >
                </div>

                <div class="mb-3">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control" >
                </div>

                <div class="mb-3">
                    <label for="category">Product Category</label>
                    <select name="category" id="category" class="form-control" >
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
