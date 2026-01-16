@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Notre Menu</h2>
    <ul class="nav nav-tabs justify-content-center mb-4" id="categoryTabs" role="tablist">
        @foreach($categories as $category)
            <li class="nav-item" role="presentation">
                <button class="nav-link @if($loop->first) active @endif" id="tab-{{ $category->id }}" data-bs-toggle="tab" data-bs-target="#cat-{{ $category->id }}" type="button" role="tab" aria-controls="cat-{{ $category->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $category->nom }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="categoryTabsContent">
        @foreach($categories as $category)
            <div class="tab-pane fade @if($loop->first) show active @endif" id="cat-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                <div class="row">
                    @foreach($category->products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->nom }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->nom }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text fw-bold">Prix: {{ $product->prix }} €</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
