<!DOCTYPE html>
<html lang="en">

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
@include('user.homecss')
    
</head>

<body>
    @include('user.header')



    <div class="container">

        <!-- ---------Left Sidebar ------------ -->
        @include('user.left_sidebar')



        <!-- ---------Main Content ------------ -->

        <!--Main start-->
        <div class="main-content">

            <div class="write-post-container">
                <form action="{{url('user_post')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="user-profile">
                        <img src="users/images/user.png" alt="" />
                        <div>
                            <p>{{ Auth::user()->name }} </p>
                        </div>
                        <!-- Here we submit the post with the Button Post -->
                        <div class="content">
                            <input type="submit" value="Post" style="position: relative; right:-170px;">
                        </div>

                    </div>

                    <div class="post-input-container">
                        <textarea rows="3" placeholder="What's on your mind?" name="description">

                    </textarea>
                    <!-- Here We are going to define Image -->
                        <div class="add-post-links">
                            <input type="file" name="image" id="" class="form-control" placeholder="image">
                    
                        </div>
                    </div>

                </form>
            </div>

            <!--Post-Container-->
            <div class="" style="margin-top: 5%;">

                @foreach($posts as $post)
             @include('user.comment')

                    
             <div class="post-contain" style="margin-top: 5%;">
                <div class="post-row mt-5">

                    <div class="user-profile">
                        <img src="users/images/user.png" alt="" />
                        <div>
                            <p>{{ $post->user->name }} </p>
                            <p></p>
                            <span>{{$post->created_at}}</span>
                        </div>
                    </div>
                </div>
                <p class="post-text">
                    {{$post->description}}
                
                </p>

                {{-- <p>Well done</p> --}}

                <img class="" src="/images/{{$post->image}}" width="1053px" height="569px" alt="" />

                <div class="post-row">
                    <div class="activity-icons mt-4">
                        <!-- <div><img src="users/images/like-blue.png" alt="" />Like</div> -->
                        <!-- <div><img src="users/images/comments.png" alt="" />Comment</div> -->
                        <div><i class="bi bi-hand-thumbs-up">Like</i></div>
                            <div style="padding-left: 150px;">
                            <i class="bi bi-chat-left">
                                <a title="text" class="btn" data-bs-toggle="modal" type="submit"   data-bs-target=.bd-example-modal-lg>Comment</a>
                            </i>

                            </div>    
                        </div>
                </div>

             </div> 

       
             @endforeach

            </div>

            <!--end post-Container-->
        </div>


        <!--Main end-->

        <!-- Modal for Comment -->



        <!-- ---------Right Sidebar ------------ -->

        
        @include('user.right_sidebar')

        <!-- ---------Footer -------------->
        <!-- @include('user.footer') -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>