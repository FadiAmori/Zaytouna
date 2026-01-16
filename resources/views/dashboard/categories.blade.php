@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Add Category</button>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->nom }}</td>
                <td>{{ $category->description }}</td>
                <td>@if($category->image)<img src="{{ asset('storage/' . $category->image) }}" width="50">@endif</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick='openEditCategoryModal(@json($category))'>Edit</button>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@include('dashboard.category_create_modal')
@include('dashboard.category_edit_modal')
</div>
@endsection
