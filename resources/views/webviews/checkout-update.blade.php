@extends('layouts.webview')

@section('title', 'Checkout Updated')

@section('content')

    <div class="header">
        <h5>Customer updated checkout</h5>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <p>Total Price: {{ $data['total_price'] }}</p>
                    <p>Total {{ count($line_items) }} variants</p>
                    <hr />
                    <div class="products-list">
                    @forelse($line_items as $item)
                        <div class="product-section">
                            <h6 class="text-muted">{{ $item['title'] }}</h6>
                            <p class="text-muted">Quantity: {{ $item['quantity'] }}</p>
                            <p class="text-muted">Total Price: {{ $item['line_price'] }}</p>
                        </div>
                        <hr />
                    @empty
                        <h4>Cart was cleaned.</h4>
                    @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection