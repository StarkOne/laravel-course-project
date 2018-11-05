<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPole:author');
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
        $allComments = Comment::whereIn('post_id', $posts)->get();
        $todayComments = $allComments->where('created_at', '=', \Carbon\Carbon::today())->count();
        return view('author.dashboard', compact('allComments', 'todayComments'));
    }
    public function comments()
    {
        $posts = Post::where('user_id',Auth::id())->pluck('id')->toArray();
        $comment = Comment::where('post_id', $posts)->get();
        return view('author.comments', compact('comment'));
    }
    public function posts()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('author.posts', compact('posts'));
    }
    public function postsNew()
    {
        return view('author.newPost');
    }
    public function createPost(CreatePost $request)
    {
        $post = new Post();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->user_id = Auth::id();
        $post->save();

        return back()->with('success', 'Ваш пост создан');
    }
    public function postsEdit($id)
    {
        $post = Post::where('id',$id)->where('user_id', Auth::id())->first();
        return view('author.editPost', compact('post'));
    }
    public function postsEditPost(CreatePost $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();
        return back()->with('success', 'Пост успешно отредактирован');
    }
    public function deletePost($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->delete();
        return back();
    }
}
