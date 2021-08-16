<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest; // useする
use App\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index(Post $post)
    {
        return view('index')->with(['posts' => $post->get()]);
    }

    public function show(Post $post,Comment $comment)
    {
        return view('show')->with(['post' => $post,'comments'=>$comment->get()]);
        
    }
    
    public function edit(Post $post)
    {
        return view('edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }

    public function create()
    {
        //return view('posts.create');　← 間違い
        return view('create');
    }
    
    public function store(Post $post, PostRequest $request) // 引数をRequest->PostRequestにする
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function comments(Comment $comment, Request $request, $post_id)
    {
        //dd($request['comment']);
        $input = $request['comment'];
        $comment->fill($input)->save();
        return redirect('/posts/' . $post_id);
    }
    
}