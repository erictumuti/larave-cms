<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //

    public function index(){

        //$posts = Post::all(); //displays all posts

       $posts = auth()->user()->posts()->paginate(5);  //shows posts belonging to that user only

        return view('admin.posts.index', ['posts'=>$posts]);
    }




    public function show(Post $post){

        return view('blog-post',['post'=>$post]);
    }

    public function create(){

        return view('admin.posts.create');
    }
    public function edit(Post $post){

        //$this->authorize('view', $post);  authorize viewing of post by user only

        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function store(){

        $inputs = request()->validate([

       'title'=> 'required|min:8|max:255',
       'post_image'=> 'file',
       'body'=> 'required'
       

        ]);
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->move('uploads/images/');
        }
        auth()->user()->posts()->create($inputs);
        //remember to import the Session class
        Session::flash('post-created-message','Post was created successfully');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post){

        $this->authorize('delete', $post);

        $post->delete();
        //remember to import the Session class
        Session::flash('message','Post was deleted');
        return back();
    }

    public function update(Post $post){

        $inputs = request()->validate([

            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'

        ]);
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->move('uploads/images/');
            $post->post_image = $inputs['post_image'];
        }
        

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->save();
        Session::flash('post-updated-message','Post was updated successfully!');
        return redirect()->route('post.index');

    }
}
