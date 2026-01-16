@extends('layouts.yummy')

@section('title', 'Accueil - Yummy')

@section('header')
    <!-- Copiez ici le header de votre index.html, adaptez les liens d'assets avec {{ asset('assets/...') }} -->
@endsection

@section('content')
    <!-- Copiez ici le contenu principal de votre index.html, adaptez les liens d'assets avec {{ asset('assets/...') }} -->
    <!-- Vous pouvez insérer du contenu dynamique Laravel ici, par exemple : -->
    <section id="menu" class="menu section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Notre Menu</h2>
        <p><span>Découvrez</span> <span class="description-title">Notre Carte</span></p>
      </div>
      <div class="container">
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          @foreach($categories as $category)
            <li class="nav-item">
              <a class="nav-link @if($loop->first) active show @endif" data-bs-toggle="tab" data-bs-target="#menu-cat-{{ $category->id }}">
                <h4>{{ $category->nom }}</h4>
              </a>
            </li>
          @endforeach
        </ul>
        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
          @foreach($categories as $category)
            <div class="tab-pane fade @if($loop->first) active show @endif" id="menu-cat-{{ $category->id }}">
              <div class="tab-header text-center">
                <p>Menu</p>
                <h3>{{ $category->nom }}</h3>
              </div>
              <div class="row gy-5">
                @foreach($category->products as $product)
                  <div class="col-lg-4 menu-item">
                    @if($product->image)
                      <a href="{{ asset('storage/' . $product->image) }}" class="glightbox"><img src="{{ asset('storage/' . $product->image) }}" class="menu-img img-fluid" alt=""></a>
                    @endif
                    <h4>{{ $product->nom }}</h4>
                    <p class="ingredients">{{ $product->description }}</p>
                    <p class="price">{{ $product->prix }} €</p>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
@endsection

@section('footer')
    <!-- Copiez ici le footer de votre index.html, adaptez les liens d'assets avec {{ asset('assets/...') }} -->
@endsection
