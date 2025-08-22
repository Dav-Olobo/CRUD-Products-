@extends('layout')

@section('title', 'Dashboard')
@section('content')

<div class="container py-12">
    <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-6">
        <div class="card-body">
            <p>You're logged in!</p>
        </div>
    </div>

    <h3 class="text-xl font-semibold mb-4">All Products</h3>

    <!-- <table class="table table-bordered table-hover"> -->
        <table id="products-table" class="table table-bordered table-hover">

        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Added By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ Str::limit($product->description, 50) }}</td>
                <td>
                    @if($product->image)
                        <img src="{{asset('$product->imagePath') }}" alt="{{ $product->name }}" width="60">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $product->user->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete the product?')">Delete</button>
                    </form>

                    <a href="{{ route('products.view', $product->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@section('datatable-scripts')
<script>
$(document).ready(function() {
    $('#products-table').DataTable({
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50],
        "order": [[ 0, "asc" ]], // order by first column (index)
        "columnDefs": [
            { "orderable": false, "targets": [5, 6] } // disable sorting for Added By & Actions
        ]
    });
});
</script>
@endsection
