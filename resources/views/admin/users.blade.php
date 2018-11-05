@extends('layouts.adminIndex')

@section('title')
    Admin Users
@endsection
<!-- Main Content -->

@section('content')

    <div class="card">
        <div class="card-header bg-light">
            Admin Users
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Post</th>
                        <th>Comments</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="text-nowrap">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->posts->count() }}</td>
                            <td>{{ $user->comments->count() }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->update_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('adminUserEdit', $user->id) }}" class="btn btn-warning"><i class="icon icon-pencil"></i></a>
                                {{--<form style="display: none" id="deleteUser-{{ $user->id }}" action="{{ route('adminDeleteUser', $user->id )}}" method="POST">--}}
                                    {{--@csrf</form>--}}
                                {{--<button type="button" onclick="document.getElementById('deleteUser-{{ $user->id }}').submit()" class="btn btn-danger">X</button>--}}
                                {{----}}
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser-{{$user->id}}">
                                    X
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($users as $user)
        <!-- Modal -->
        <div class="modal fade" id="deleteUser-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are about to delete {{ $user->name }}.</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep.</button>
                        <form style="display: inline-block" id="deleteComment-{{$user->id}}" action="{{ route('adminDeleteUser', $user->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-primary">Yes, delete.</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection