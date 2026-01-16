@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">Add Product</button>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->nom }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->prix }}</td>
                <td>@if($product->image)<img src="{{ asset('storage/' . $product->image) }}" width="50">@endif</td>
                <td>{{ $product->category->nom ?? '' }}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick='openEditProductModal(@json($product))'>Edit</button>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@include('dashboard.product_create_modal')
@include('dashboard.product_edit_modal')
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/product_modal.js') }}"></script>
@endpush
