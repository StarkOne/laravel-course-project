@extends('layouts.adminIndex')

@section('title')
    Admin Comments
@endsection
<!-- Main Content -->

@section('content')

    <div class="card">
        <div class="card-header bg-light">
            Admin Comments
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Post</th>
                        <th>Content</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Auth::user()->comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td class="text-nowrap"><a href="{{ route('singlePost', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                            <td>
                                {{--<form id="deleteComment-{{ $comment->id }}" action="{{ route('adminDeleteComments', $comment->id) }}" method="POST">--}}
                                    {{--@csrf</form>--}}
                                {{--<button type="button" onclick="document.getElementById('deleteComment-{{ $comment->id }}').submit()" class="btn btn-danger">X</button>--}}
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteComment-{{$comment->id}}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($comments as $comment)
        <!-- Modal -->
        <div class="modal fade" id="deleteComment-{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are about to delete for post {{ $comment->post->title }}.</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
                        <form style="display: inline-block" id="deleteComment-{{$comment->id}}" action="{{ route('adminDeleteComments', $comment->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-primary">Yes, delete it.</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection