@extends('layouts.master')

@section('title')
    {{ $product->title }}
@endsection

@section('content')
    <header class="masthead" style="background-image: url({{ asset('img/home-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{{ $product->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img class="img-fluid" src="{{ asset($product->thumbnail) }}" alt="">
            </div>
            <div class="col-md-7">
                <h2 class="post-title">
                    {{ $product->title }}
                </h2>
                <p class="post-meta description">{{ $product->description }}</p>
                <hr>
                <p class="post-meta">{{ $product->price }} USD</p>
                <hr>
                <a href="{{ route('shop.orderProduct', $product->id) }}" class="btn btn-primary">Buy</a>
            </div>
        </div>
    </div>
@endsection