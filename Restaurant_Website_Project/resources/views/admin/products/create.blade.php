@extends('layouts.master')

@section('title', 'Category')

@section('content')

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="image" name="image">
            <label class="custom-file-label" for="image">Choose file</label>
        </div>
        @if ($product->image)
        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail mt-3" style="max-width: 200px;">
        @endif
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remove_image" name="remove_image">
        <label class="form-check-label" for="remove_image">Remove image</label>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
