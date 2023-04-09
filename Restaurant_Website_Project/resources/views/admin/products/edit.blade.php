@extends('layouts.master')

@section('title', 'Edit Product')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Edit Product</h4>
        </div>
        <div class="card-body">
    
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                       <div>{{ $error }}</div> 
                    @endforeach
                </div>
                
            @endif
    
            <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div class="mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                </div>
    
                <div class="mb-3">
                    <label for="description">Product Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
                </div>
    
                <div class="mb-3">
                    <label for="price">Product Price</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="{{ $product->price }}" required>
                </div>
    
                <div class="mb-3">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                </div>
    
                <div class="mb-3">
                    <label for="category">Product Category</label>
                    <select name="category" id="category" class="form-control" required>
                        {{-- @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($category->id == $product->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
    
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
    
            </form>
    
        </div>
    </div>
</div>
@endsection    