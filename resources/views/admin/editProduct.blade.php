@extends('layouts.adminIndex')

@section('title')
    Editing {{ $product->title }}
@endsection

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            New Product
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

                        <form action="{{ route('adminEditProductsPost', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-file" class="form-control-label">Thumbnail</label>
                                            <input name="thumbnail" type="file" id="normal-file" class="form-control-file">
                                        </div>
                                        <img src="{{asset($product->thumbnail)}}" alt="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="normal-input" class="form-control-label">Title</label>
                                            <input name="title" value="{{ $product->title }}" id="normal-input" class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="inlineFormInputGroupUsername">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input type="number" value="{{ $product->price }}" name="price" class="form-control" id="inlineFormInputGroupUsername" placeholder="Price">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="placeholder-input" class="form-control-label">Description</label>
                                            <textarea id="placeholder-input" name="description" class="form-control" cols="30" rows="10" placeholder="Description...">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Update product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection