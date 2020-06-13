<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function show(Post $post){

        return view('blog-post',['post'=>$post]);
    }

    public function create(){

        return view('admin.posts.create');
    }
    public function store(){

        dd(request()->all());
    }
}
