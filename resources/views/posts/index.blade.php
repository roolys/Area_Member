@extends('layout.app')

@section('content')

{{-- header Logout --}}




<nav>
    <div class="nav-left">
        <img class="logo" src="users/images/" alt="" />

    </div>

    <div class="nav-right">
        <div class="list-inline-item logout">     

        @if(Route::has('login'))

        @auth

            <x-app-layout>
                      
            </x-app-layout>
        @endauth    
        @endif    
        </div>    
    </div>
</nav>

{{-- {{dd($posts->toArray())}} --}}
<div class="bg-gray-50 py-16 px-4 sm:px-6 sm:grid">
   <div class="text-center">
    <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">Welcome to the class</h2>
    <p class="max-w-2xl mx-auto mt-5 text-xl leading-7 text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius a dolorem reiciendis 
         cum inventore esse accusamus dolorem enim rem asperiores, maiores nihil reiciendis!</p>
   </div>
   {{-- Post Form started --}}
   <div class="rounded-lg shadow overflow-hidden">
    {{-- Header --}}

    <form action="/posts" method="POST" class="mb-0">

        @csrf

            <div class="mt-6 flex items-center">


                {{-- Author --}}
                <div class="flex-shrink-0">
                    <img class=" h-10 w-10 rounded-full" src="users/images/user.png" alt="author avatar">
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-gray-500">{{Auth::user() -> name}}</p>
                    <div class="flex text-sm leading-5 text-gray-500">
            
                    </div>
                </div>

                {{-- Post Button  --}}
                <div class="absolute right-10">
                    <button type="submit" class="mt-1 py-3 px-5  w-full border border-transparent shadow-sm text-sm font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none">Post</button>

                </div>
            
            </div>

            <div class="flex-1 p-6 flex-col justify-between">
                <div class="flex-1">

                    {{-- <a href="/">                        
                        <h3 class="mt-2 text-xl leading-7 font-semibold text-gray-900">Hello</h3>
                    </a> --}}
                    <textarea rows="3" placeholder="What's on your mind?" name="description"></textarea>

                    <!-- Here We are going to define Image -->
                    <div class="add-post-links">
                        <input type="file" name="image" id="" class="form-control" placeholder="image">
                
                    </div>

                </div>
                
            </div>

    </form>
    
</div> 

{{-- Post form end  --}}



{{--Posts Wrapper--}}
    <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
   
        @foreach($posts as $post) 
        {{-- Post --}}
        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
            {{-- Header --}}

            <div class="mt-6 flex items-center">
                {{-- Author --}}
                <div class="flex-shrink-0">
                    <img class=" h-10 w-10 rounded-full" src="users/images/user.png" alt="author avatar">
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-gray-500">{{$post->user->name}}</p>
                    <div class="flex text-sm leading-5 text-gray-500">
                        <time datetime="{{$post->created_at}}">
                            {{$post->created_at->diffForHumans()}}
                        </time>
                    </div>
                </div>
                {{-- Date --}}
            </div>

            <div class="flex-1 p-6 flex flex-col justify-between">
                <div class="flex-1">

                    <a href="/posts/{{$post -> id}}">                            {{-- Title --}}
                         <h3 class="mt-2 text-xl leading-7 font-semibold text-gray-900">{{$post->description}}</h3>
                    </a>

                                {{-- Text
                <p class="mt-3 text-base leading-6 text-gray-500">
                    @if(strlen($post -> text)>200)
                        {{substr($post -> text, 0, 200)}}...
                    @else
                    {{$post->text}}
                    @endif
                </p> --}}

                </div>
                
            </div>

            <div class="flex-shrink-0">
                {{-- Image --}}
                <img class="h-80 w-full object-cover" src="https://images.unsplash.com/photo-1614624532983-4ce03382d63d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1031&q=80" alt="">
            </div>
            
            <div class="my-3 mx-auto ">
                <i class="bi bi-chat-left">
                    <a href="/posts/{{$post->id}}">Comment</a>
                </i>
            </div>    
            
        </div> 

        @endforeach   
    </div>
</div>


@endsection