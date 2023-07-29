<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\QueryExceptiopn;
use Illuminate\Database\Eloquent\Builder;


class  HomeController extends Controller
{
    // public function header(){
    //     return view('home.header');
    // }

    //Home page View
    public function homepage(){
        return view('home.homepage');
    }
    //Function  to redirect user or admin in her page and display data
    public function index(){
        if(Auth::id()){
            $usertype=Auth()->user()->usertype;

            if($usertype=='user'){      
                
                $posts=Post::All()->sortByDesc('created_at');

                return view('user.my_post',compact('posts'));
            }
            else if($usertype=='admin'){
                $posts=Post::All()->sortByDesc('created_at');
                //$posts = Post::all();
                $count = Post::count();
                return view('admin.adminhome')->with(['posts' => $posts, 'count' => $count]);
        
                //return view('admin.adminhome');
            }
            else{
                return redirect()->back(); 
            }
        } 
    } 
    
    //Store data posts in the database
    public function user_post(Request $request){
        $request->validate([
            // 'description'=>'required',
            // 'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $user=Auth()->user();
        $user_id=$user->id;
        $name=$user->name;
        $usertype=$user->usertype;

        $post=new Post;
        $post->user_id=$user_id; 
        $post->name=$name;
        $post->usertype=$usertype;
        $post->description=$request->description;
        // $post->image='image|mimes:jpeg,png,jpg,gif,svg|max:2048';
         $image=$request->file('image');

        if($image){
            $destinationPath='images/';
            $profileImage=date('ymdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $post->image=$profileImage;
        }
        
        // $imagePath='storage/'.$request->file('image')->store('postImage','public');

        //Keeping image in public folder
        // $image=$request->image;
        // $imagename=time().''.$image->getClientOriginalExtension();
        // $request->image->move('postImage',$imagename);

        //Storing image in Database
        // $post->image=$imagename;
         

        // $post->post_status='active';
        $post->save();
        return redirect()->route('my_post')->with('status', 'Post added');

    }

    public function liste_posts(){
        $posts = Post::all();
        $count = Post::count();
        return view('admin.adminhome')->with(['posts' => $posts, 'count' => $count]);

      //return view ('admin.adminhome',compact('posts'));  
    }

    //Public Store
    public function store(Request $request){

         //Keeping image in public folder
        //  $image=$request->image;
        //  $imagename=time().''.$image->getClientOriginalExtension();
        //  $request->image->move('postImage',$imagename);
 
         //Storing image in Database

        //  $image='storage/'.$request->file('image')->store('postimage','public');
        //  $post=new Post();
        //  $post->image=$image;
        //  $post->save();
        // return redirect()->route('my_post')->with('status', 'Post added');        
    }
    //Display post 
    public function my_post(){
        $user=Auth::user();
        $user_id=$user->id;
        // $posts=Post::where('user_id','=',$user_id)->get();
        $posts=Post::All()->sortByDesc('created_at');

        return view('user.my_post',compact('posts'));
    }
    //delete post
    public function delete_post($id){
        $post = Post::find($id);
            //dd($post);
        $post->delete();
        return redirect()->back(); 
    }

    //Store comment in database
    public function comment_post(Post $post, Request $request,$id){
        $request->validate([
            'comment'=>'required'
           // 'comment'=>['required','string','between:2,255'],
        ]);
        $user=Auth()->user();
        $user_id=$user->id;
        $post_id=$post->id;
        $name=$user->name;
        $usertype=$user->usertype;

        //New instance of post 
    

        //New instance of model Comment
        $comment=new Comment;
        //Attribute value for every field in the table comments
        $comment->post_id=$post_id;
        $comment->name=$name;
        $comment->usertype=$usertype;

        $comment->comment=$request->comment;
        //Save data in the table with the save() method
        // $comment->save();
        $comment->save();

        //Redirection to create and display comment
        return redirect()->route('comment')->with('status','Comment added');
    }

    //Display comment 
    public function comment(Post $post){
        $posts = Post::all();
        $user=Auth::user();
        $user_id=$user->id;
        $post_id=$post->id;
        //SortBy By created_at to range the comments    
        $comments=Comment::All()->sortByDesc('created_at');

        return view('user.comment',compact('comments'));

    }

    public function reject_post($id){
        
        $post=Post::find($id);
       // dd($post);
        $post->post_status= 'rejected';
        $post->save();
       // return redirect(route('admin.adminhome'))->with('status', 'Le post a bien été bloqué avec succes.');
    // return redirect(route('admin.adminhome'))->with('status', 'Le post a bien été bloqué avec succes.');
    return redirect()->back(); 
    }

   

      
}
