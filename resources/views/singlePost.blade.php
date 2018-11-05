@extends('layouts.master')

@section('title')
    {{ $post->title }}
@endsection

@section('content')

    <header class="masthead" style="background-image: url({{ asset('img/home-bg.jpg') }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>{{ $post->title }}</h1>
                        <p class="post-meta">Posted by
                            <a href="#">{{ $post->user->name }}</a>
                            on {{ date_format($post->created_at, 'F d, Y') }}
                            | <i class="fa fa-comment"></i> {{ $post->comments->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>{!! $post->content !!}</p>
            </div>
        </div>
    </div>
</article>
    <hr>
    <div class="container">
        <div class="row">
                <div class="comments col">
                    <h3>Comments</h3>
                    @foreach($post->comments as $comment)
                        <p>{{ $comment->content }}</p>
                        <p><small>by {{$comment->user->name}}, on {{ date_format($comment->created_at, 'F d, Y') }}</small></p>
                        <hr>
                    @endforeach


                    @if(Auth::check())
                        <form method="POST" action="{{ route('newComment') }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Comment..." name="comment" id="" cols="30" rows="10"></textarea>
                                <input type="hidden" name="post" value="{{$post->id}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Make Comment</button>
                            </div>
                        </form>
                    @endif
                </div>

        </div>
    </div>
@endsection