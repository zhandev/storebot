@extends('layouts.webview')

@section('title', 'Cart Create')

@section('content')
    <hr>
    <ul class="list-group">
        @forelse($line_items as $item)
            <li class="list-group-item">
                <h5>{{ $item['title'] }}</h5>
                <p class="text-muted">Quantity: {{ $item['quantity'] }}</p>
                <p class="text-muted">Total Price: {{ $item['line_price'] }}</p>
            </li>
        @empty
            <h4>Cart was cleaned.</h4>
        @endforelse
    </ul>
@endsection