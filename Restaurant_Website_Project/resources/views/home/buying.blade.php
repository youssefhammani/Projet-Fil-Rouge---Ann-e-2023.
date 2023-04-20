@extends('home')

@section('content')
    @php
        session()->forget('orders');
    @endphp

    <main class="mn">
        <section>
            <section>
                <div class="container px-3 my-5 clearfix">
                    <!-- Shopping cart table -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center">order tracking</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Shipping</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($info as $item)
                                            
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}$</td>
                                            <td>{{ $item->Quantity }}</td>
                                            <td>{{ $item->Shipping }}$</td>
                                            <td>@mdo</td>
                                            <td>{{ $item->Total + $item->price * $item->Quantity }}</td>
                                            @if($item->Status == "true")
                                            <td class="fw-bold text-success">Order Complete</td>
                                            @else
                                            <td class="fw-bold text-info">The request is in progress</td>
                                            @endif
                                            <td><a href="" class="fw-bold text-secondary">Download</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                </section>
    </main>
@endsection
