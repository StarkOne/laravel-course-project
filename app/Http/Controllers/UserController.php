<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\UserUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }
    public function comments()
    {
        $comments = Comment::where('user_id', Auth::id())->get();
        return view('user.comments', compact('comments'));
    }
    public function profile()
    {
        return view('user.profile');
    }
    public function profilePost(UserUpdate $request)
    {
        $user = Auth::user();

        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($request['password'] !== '') {
            if(!Hash::check($request['password'], Auth::user()->password) ){
                return redirect()->back()->withErrors(['password' => 'Пароль не верен']);
            }

            if($request['new_password'] == '' && $request['new_password_confirmation'] == '') {
                $user->save();
                return redirect()->back()->with('success', 'Данные успешно изменены');
            } else {
                if(!strcmp($request['new_password'], $request['new_password_confirmation']) == 0) {
                    return redirect()->back()->withErrors(['new_password' => 'Пароли не совподают']);
                } else {
                    $validation = $request->validate([
                        'password'  => 'required|min:3',
                        'new_password'  => 'required|min:3|confirmed'
                    ]);
                    $pass = bcrypt($request['new_password']);
                    $user->password = $pass;
                    $user->save();
                    return redirect()->back()->with('success', 'Ваш пароль изменён');
                }
            }
        }
    }
    public function delete($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::id());
        if ($comment) {
            $comment->delete();
        }
        return back();
    }
    public function newComment(Request $request)
    {
        $comment = new Comment();
        $comment->post_id = $request['post'];
        $comment->user_id = Auth::id();
        $comment->content = $request['comment'];
        $comment->save();
        return back();
    }
}
