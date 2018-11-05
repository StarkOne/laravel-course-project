@extends('layouts.master')

@section('title')
    Магазин
@endsection
<!-- Main Content -->

@section('content')
    <header class="masthead" style="background-image: url({{ asset('img/home-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Laravel shop</h1>
                        <span class="subheading">Shop powered by laravel</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach($products as $product)
                    <div class="post-preview">
                        <div class="row">
                            <div class="col-lg-3">
                                <img class="img-fluid" src="{{ asset($product->thumbnail) }}" alt="">
                            </div>
                            <div class="col-lg-9">
                                <a href="{{ route('shop.singleProduct', $product->id) }}">
                                    <h2 class="post-title">
                                        {{ $product->title }}
                                    </h2>
                                </a>
                                <p class="post-meta">$ {{ $product->price }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>
                @endforeach
            <!-- Pager -->
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection