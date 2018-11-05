@extends('layouts.adminIndex')

@section('title')
    Admin Posts
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">
            Admin Posts
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Comments</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Auth::user()->posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td class="text-nowrap"><a href="{{ route('singlePost', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                            <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                            <td>{{ $post->comments->count() }}</td>
                            <td>
                                <a href="{{ route('adminPostEdit', $post->id) }}" class="btn btn-warning">Edit</a>
                                {{--<form style="display: inline-block" id="deletePost-{{$post->id}}" action="{{ route('adminDeletePost', $post->id) }}" method="POST">@csrf</form>--}}
                                {{--<a onclick="document.getElementById('deletePost-{{ $post->id }}').submit()" class="btn btn-danger">Remove</a>--}}
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{$post->id}}">
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

   @foreach($posts as $post)
       <!-- Modal -->
       <div class="modal fade" id="deletePostModal-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">You a about to delete {{ $post->title }}.</h5>
                   </div>
                   <div class="modal-body">
                       Are you sure?
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
                       <form style="display: inline-block" id="deletePost-{{$post->id}}" action="{{ route('adminDeletePost', $post->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-primary">Yes, delete it.</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   @endforeach

@endsection