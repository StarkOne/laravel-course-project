@extends('layouts.adminIndex')

@section('title')
    Editing {{ $user->name }}
@endsection

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Edit user
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

                        <form action="{{ route('adminUserEditPost', $user->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Name</label>
                                            <input name="name" value="{{ $user->name }}" id="normal-input" class="form-control" placeholder="User name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}" id="normal-input" class="form-control" placeholder="User email">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="toggle-switch" data-ts-color="success">
                                        <label for="ts4" class="ts-label">Admin</label>
                                        <input id="ts4" type="checkbox" name="admin" value="1" {{ $user->admin ? 'checked' : '' }} hidden="hidden">
                                        <label for="ts4" class="ts-helper"></label>
                                    </div>
                                </div>

                                <div class="col-md-3 my-2">
                                    <div class="toggle-switch" data-ts-color="success">
                                        <label for="ts5" class="ts-label">Author</label>
                                        <input id="ts5" type="checkbox" name="author" value="1" {{ $user->author ? 'checked' : '' }} hidden="hidden">
                                        <label for="ts5" class="ts-helper"></label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Edit user</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection