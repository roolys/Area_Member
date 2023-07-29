@extends('layout.app')

@section('content')

{{-- Login Section  --}}

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


<div class="bg-gray-50 py-16 px-4 sm:grid sm:grid-cols-12">
    <div class="sm:col-start-4 sm:col-span-6">
        <a href="/home">
            <div class="bg-white text-center px-4 py-3 rounded-sm shadow-sm hover:shadow-md">Back</div>
        </a>
        <div class="bg-white mt-4 px-4 py-6 rounded-sm shadow-sm">
            <div class="mt-6 flex items-center">
                {{-- Author --}}
                <div class="flex-shrink-0">
                    {{-- <img class=" h-10 w-10 rounded-full" src="users/images/user.png" alt=""> --}}
                    <img class="h-10 w-10 rounded-full" src="/users/images/user.png" alt="">
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-gray-500">{{$post->user->name}}</p>
                    <div class="flex text-sm leading-5 text-gray-500">
                        <time datetime="{{$post->created_at}}">
                            {{$post->created_at->diffForHumans()}}
                        </time>
                    </div>
                </div>            
            </div>

            {{-- Description --}}
            
            <div class="flex-1 p-6 flex flex-col justify-between">
                <div class="flex-1">

                    <a href="/posts/{{$post -> id}}">                            {{-- Title --}}
                         <h3 class="mt-2 text-xl leading-7 font-semibold text-gray-900">{{$post->description}}</h3>
                    </a>
                </div>              
            </div>

            {{-- Image --}}
            <div class="flex-shrink-0">
                <img class="h-80 w-full object-cover" src="https://images.unsplash.com/photo-1614624532983-4ce03382d63d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1031&q=80" alt="">
            </div>
        </div>

            {{-- Comment Section  --}}

        <h2 class="mt-6 text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Comments</h2>

        <div>
            <form action="/posts/{{$post->id}}/comments" method="POST" class="mb-0">

                @csrf

                <div class="flex h-12">
                    <input class="block w-full borded bg-slate-50 mt-1 py-2 rounded-lg px-3 text-slate-900 focus:outline focus:outline-2 focus:outline-indigo-500" type="text" name="comment" value="{{old('comment')}}" placeholder="Quelque chose à rajouter?" autocomplete="off" required>
                    <button class="ml-2 w-12 flex justify-center items-center shrink-0 bg-indigo-700 rounded-full text-indigo-50" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                    </button>                  
                </div>
                {{-- Displaying Error  --}}
                @if($errors->any())

                <div class="mt-6">
                    <ul class="bg-red-100 px-4 py-5 rounded-md">
                        @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>              
                        @endforeach
                    </ul>
                </div>

                @endif
            </form>                        
        </div>

        @foreach($comments as $comment)

        <div class="bg-white mt-4 px-4 py-6 rounded-sm shadow-sm">
            <div class="mt-6 flex items-center">
                {{-- Author --}}
                <div class="flex-shrink-0">

                    <div>
                        <?php
                            $parts = explode(' ', $comment->user->name);
                            $initials = strtoupper($parts[0][0] . $parts[count($parts)-1][0]);    
                        ?>
                        <span class="bg-gray-300 p-3 rounded-full">{{$initials}}</span>
                    </div>

                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-gray-500">{{$comment->user->name}}</p>
                    <div class="flex text-sm leading-5 text-gray-500">
                        <time datetime="{{$comment->created_at}}">
                            {{$comment->created_at->diffForHumans()}}
                        </time>
                    </div>
                </div>            
            </div>

            {{-- Comment --}}
            
            <div class="flex-1 p-6 flex flex-col justify-between">
                <div class="flex-1">

                    <a href="/posts/{{$post -> id}}">                            {{-- Title --}}
                         <h3 class="mt-2 text-xl leading-7 font-semibold text-gray-900">{{$comment->comment}}</h3>
                    </a>
                </div>              
            </div>

        </div>
       
        @endforeach


    </div>
</div>

@endsection
