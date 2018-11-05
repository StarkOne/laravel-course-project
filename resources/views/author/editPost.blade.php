@extends('layouts.adminIndex')

@section('title')
    Editing {{ $post->title }}
@endsection

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Edit Post
                        </div>

                        @if(Session::has('success'))
                            <div class="alert alert-success m-2">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger m-2">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('authorPostEditPost', $post->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Title</label>
                                            <input name="title" value="{{ $post->title }}" id="normal-input" class="form-control" placeholder="Post title">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="placeholder-input" class="form-control-label">Content</label>
                                            <textarea id="placeholder-input" name="content" class="form-control" cols="30" rows="10" placeholder="Post Content">{{ $post->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Update post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection