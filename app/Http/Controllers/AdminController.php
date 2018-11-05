<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePost;
use App\Http\Requests\UserEdit;
use App\Http\Requests\UserUpdate;
use App\Post;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPole:admin');
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $posts = Post::all();
        $comments = Comment::all();
        $users = User::all();
        return view('admin.dashboard', compact('posts','comments','users'));
    }
    public function comments()
    {
        $comments = Comment::all();
        return view('admin.comments', compact('comments'));
    }
    public function posts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function postsEdit($id)
    {
        $post = Post::where('id', $id)->first();
        return view('admin.editPost', compact('post'));
    }
    public function postsEditPost(CreatePost $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();
        return back()->with('success', 'Пост успешно отредактирован');
    }
    public function deletePost($id)
    {
        $post = Post::where('id', $id)->first();
        $post->delete();
        return back();
    }
    public function deleteComments($id)
    {
        $post = Comment::where('id', $id)->first();
        $post->delete();
        return back();
    }
    public function usersEdit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.editUser', compact('user'));
    }
    public function usersEditPost(UserEdit $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request['name'];
        $user->email = $request['email'];

        if($request['author'] == 1) {
            $user->author = true;
        } else {
            $user->author = false;
        }
        if($request['admin'] == 1) {
            $user->admin = true;
        } else {
            $user->admin = false;
        }
        $user->save();
        return back()->with('success', 'Пользователь успешно отредактирован');
    }
    public function userDelete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return back();
    }

    //products

    public function products()
    {
        $products = Product::paginate(5);
        return view('admin.products', compact('products'));
    }
    public function newProduct()
    {

        return view('admin.newProduct');
    }
    public function newProductPost(Request $request)
    {
        $this->validate($request, [
           'title' => 'required|string',
           'thumbnail' => 'required|file',
            'description' => 'required',
            'price' => 'required',
        ]);
        $product = new Product();
        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->price = $request['price'];

        $thumbnail = $request->file('thumbnail');
        $fileName = $thumbnail->getClientOriginalName();
        $fileExtension = $thumbnail->getClientOriginalExtension();
        $thumbnail->move('img/product-images', $fileName);

        $product->thumbnail = 'img/product-images/' . $fileName;

        $product->save();
        return back()->with('success',  'Product добавлен');
    }
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.editProduct', compact('product'));
    }
    public function editProductPost(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'thumbnail' => 'file',
            'description' => 'required',
            'price' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->price = $request['price'];

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $fileName = $thumbnail->getClientOriginalName();
            $thumbnail->move('img/product-images', $fileName);
            $product->thumbnail = 'img/product-images/' . $fileName;
        }
        $product->save();
        return back()->with('success',  'Product обновлён');
    }
    public function editProductDelete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back();
    }
}
