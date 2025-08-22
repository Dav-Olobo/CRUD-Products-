@extends('layout')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $product->name }}</h1>

    <div class="row">
        @if($product->image)
        <div class="col-md-4">
            <img src="{{ asset('storage/products/' . basename($product->image)) }}" class="img-fluid rounded mb-3" alt="{{ $product->name }}">
        </div>
        @endif

        <div class="col-md-8">
            <h3>Price: ${{ number_format($product->price, 2) }}</h3>
            <p>{{ $product->description }}</p>
            <p><strong>Added by:</strong> {{ $product->user->name ?? 'N/A' }}</p>

            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
            </form>

            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
        </div>
    </div>
</div>
@endsection
