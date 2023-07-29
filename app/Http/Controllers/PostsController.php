<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\PostsRequest;




class PostsController extends Controller
{
    //
    public function index()
    {
        if(Auth::id()){
            $usertype=Auth()->user()->usertype;

            if($usertype=='user'){      
                
                $posts=Post::All()->sortByDesc('created_at');
                $comments=Comment::All()->sortByDesc('created_at');

                return view('posts.index', compact('posts'));
            }
            else if($usertype=='admin'){
                return view('admin.adminhome');
            }
            else{
                return redirect()->back(); 
            }
        } 
    }



    
    public function show(Post $post)
    {

        
        return view('posts.show', [
            'post' => $post,
            'comments' => $post -> comments() -> get()
        ]);


    }



    public function store(PostsRequest $request)
    {       
        $user=Auth()->user();    
        $user_id=$user->id;
        $name=$user->name;
        $usertype=$user->usertype;

        $post=new Post;
        $post->user_id=$user_id; 
        $post->name=$name;
        $post->usertype=$usertype;
             
        $post->description=$request->description;
        $image=$request->file('image');

        if($image){
            $destinationPath='image/';
            $profileImage=date('ymdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $post->image=$profileImage;
        }
        
        $post -> save();
        return redirect('/home');
    }
}
