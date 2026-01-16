@php
$activeCategory = request('category');
@endphp
<ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
  <li class="nav-item">
    <a class="nav-link {{ $activeCategory ? '' : 'active show' }} menu-category-btn" href="#" data-category="">All</a>
  </li>
  @foreach($categories as $category)
  <li class="nav-item">
    <a class="nav-link {{ $activeCategory == $category->id ? 'active show' : '' }} menu-category-btn" href="#" data-category="{{ $category->id }}">{{ $category->nom }}</a>
  </li>
  @endforeach
</ul>
<div class="tab-content" data-aos="fade-up" data-aos-delay="200">
  <div class="tab-pane fade active show" id="menu-products">
    <div class="tab-header text-center">
      <p>Menu</p>
      <h3>
        @if($activeCategory)
          {{ $categories->where('id', $activeCategory)->first()?->nom ?? 'Products' }}
        @else
          All Products
        @endif
      </h3>
    </div>
    <div class="row gy-5">
      @forelse($products as $product)
        <div class="col-lg-4 menu-item">
          <a href="{{ asset('storage/' . $product->image) }}" class="glightbox"><img src="{{ asset('storage/' . $product->image) }}" class="menu-img img-fluid" alt=""></a>
          <h4>{{ $product->nom }}</h4>
          <p class="ingredients">{{ $product->description }}</p>
          <p class="price">${{ $product->prix }}</p>
        </div>
      @empty
        <div class="col-12 text-center">No products found.</div>
      @endforelse
    </div>
  </div>
</div>
