@extends('layout')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $product->name }}</h1>

    <div class="row">
        @if($product->image)
        <div class="col-md-4">
        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">      
        </div>
        @endif

        <div class="col-md-8">
            <h3>Price: ${{ number_format($product->price, 2) }}</h3>
            <p>{{ $product->description }}</p>
            <p><strong>Added by:</strong> {{ $product->user->name ?? 'N/A' }}</p>
            @auth

            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
            </form>
            @endauth

            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>
    </div>
</div>
@endsection
