@extends('layouts.adminIndex')

@section('title')
    Admin products
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">
            Admin products
            <a href="{{ route('adminNewProducts') }}" class="ml-2 btn btn-primary">New Product</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><img src="{{ asset($product->thumbnail) }}" width="100"></td>
                            <td class="text-nowrap"><a href="{{ route('adminEditProducts', $product->id) }}">{{ $product->title }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }} USD</td>
                            <td>
                                <a href="{{ route('adminEditProducts', $product->id) }}" class="btn btn-warning">Edit</a>
                                {{--<form style="display: inline-block" id="deletePost-{{$post->id}}" action="{{ route('adminDeletePost', $post->id) }}" method="POST">@csrf</form>--}}
                                {{--<a onclick="document.getElementById('deletePost-{{ $post->id }}').submit()" class="btn btn-danger">Remove</a>--}}
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal-{{$product->id}}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    @foreach($products as $product)
        <!-- Modal -->
        <div class="modal fade" id="deleteProductModal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">You are about to delete {{ $product->title }}.</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, keep it.</button>
                        <form style="display: inline-block" id="deletePost-{{$product->id}}" action="{{ route('adminEditProductsDelete', $product->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-primary">Yes, delete it.</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection