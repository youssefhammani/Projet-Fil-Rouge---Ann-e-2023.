@extends('layouts.master')

{{-- @section('title', 'View Users') --}}

@section('content')
    <div class="container-fluid px-4">

        <div class="card mt-4">
            <div class="card-header">
                <h4>View Orders</h4>
            </div>
            <div class="card-body">

                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Product name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Shipping</th>
                            <th>Address</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>created_at</th>
                            {{-- <th>Invoice</th> --}}
                            <th>Action</th>
                            {{-- <th>Modify permission</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($info as $item)
                            <tr>
                                <td><img src="{{ asset('uploads/images/products' . $item->image) }}" alt=""
                                        style="width: 45px; height: 45px" class="rounded" />
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->Quantity }}</td>
                                <td>{{ $item->Shipping }}</td>
                                {{-- <td>{{ $item->Address }}</td> --}}
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->Total + $item->price * $item->Quantity }}</td>
                                {{-- <td>{{ $item->Status }}</td> --}}
                                @if ($item->Status == 'false')
                                <td>
                                    <div href="" class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </td>
                                @else
                                <td>
                                    <dev class="btn btn-success"><i class="fa-solid fa-circle-check"></i></dev>
                                </td>
                                @endif
                                <td>{{ $item->created_at }}</td>
                                {{-- <td><a href="" class="fw-bold text-secondary">Download</a></td> --}}
                                <td>
                                    <a href="{{ url('admin/users/'.$item->id.'/done') }}" class="btn btn-outline-primary">Done</a>
                                    <a href="{{ url('admin/users/'.$item->id) }}" class="btn btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
