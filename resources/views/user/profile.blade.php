@extends('layouts.adminIndex')

@section('title')
    Редактирования профиля
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Account Settings
                    </div>

                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger m-2">
                            <ul class="m-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="" method="POST">
                        @csrf

                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-md-4 mb-4">
                                <div>Profile Information</div>
                                <div class="text-muted small">These information are visible to the public.</div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Name</label>
                                            <input name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Email Address</label>
                                            <input name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="row mt-5">
                            <div class="col-md-4 mb-4">
                                <div>Access Credentials</div>
                                <div class="text-muted small">Leave credentials fields empty if you don't wish to change the password.</div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Current Password</label>
                                            <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">New password</label>
                                            <input name="new_password" type="password" class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">New password Confirmation</label>
                                            <input name="new_password_confirmation" type="password" class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light text-right">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection