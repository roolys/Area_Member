<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentsRequest;



class CommentsController extends Controller
{
    //


    public function store(Post $post, CommentsRequest $request){

        $user=Auth()->user();
        $name=$user->name;
        $usertype=$user->usertype;

        $comment=new Comment;
        $comment->post_id=$post->id;
        $comment->user_id=$user->id;
        $comment->name=$name;
        $comment->usertype=$usertype;
        $comment->comment=$request->comment;

        $comment->save();

        return back();
    }

  
}
