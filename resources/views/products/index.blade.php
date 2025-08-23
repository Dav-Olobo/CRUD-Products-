@extends('layout')

@section('title', 'Welcome')

@section('content')
    <main class="py-4 container">
        <div class="text-center mt-5">
            @guest
                <h1 class="display-5 fw-bold mb-3">Welcome to Our Marketplace</h1>
                <p class="lead text-muted mb-4">
                    Explore our products or join our community to start selling your own.
                </p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">Register</a>
                </div>
            @endguest
        </div>

        <h2 class="mb-4 text-center">Featured Products</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <p class="card-text text-muted mb-3">₦{{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary mt-auto">View Details</a>
                            
                            @guest
                                <button class="btn btn-success mt-2">Buy Now</button>
                                <button class="btn btn-info mt-2">Add to Cart</button>
                            @endguest

                            @auth
                                <div class="mt-2 d-grid gap-2 d-md-flex justify-content-md-start">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning me-md-2">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="lead">No products available yet. Check back soon!</p>
                </div>
            @endforelse
        </div>
    </main>
@endsection

@push('styles')
<style>
    .product-image {
        max-height: 200px; /* Adjust this value as needed */
        width: 100%;
        object-fit: cover; /* Ensures the image covers the area without distortion */
    }
</style>
@endpush