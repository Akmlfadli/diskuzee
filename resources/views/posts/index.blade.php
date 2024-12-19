<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  <div class="page" style="display: flex; flex-wrap: wrap; justify-content: center;">
   <div class="post">
    <button class="btn" style="background-color: blue; color: white; margin-bottom: 20px;" onclick="window.location.href = '/home'">Back</button>
    @foreach ($post as $posts)
    <div class="profile" style="display: flex; align-items: center; margin-bottom: 30px;">
      <img src="{{ $posts->profile_author }}" style="height: 50px; width: 50px; margin-right: 10px; border-radius: 10px;"/>
      <h1 style="font-size: 20px;">{{ $posts->author }}</h1>
    </div>
    <h1>{{ $posts->title }}</h1>
    <p>{{ $posts->deskripsi }}</p>
    @if ($posts->image1)
    <center><img src="{{ $posts->image1 }}" style="max-height: 500px; max-width: 400px;"/></center>
    @endif
    @if ($posts->image2)
    <center><img src="{{ $posts->image2 }}" style="max-height: 500px; max-width: 400px;"/></center>
    @endif
    @if ($posts->image3)
    <center><img src="{{ $posts->image3 }}" style="max-height: 500px; max-width: 400px;" /></center>
    @endif
    <small>{{ $posts->upload_date }}</small>
   </div>
  </div>
  <div class="page" style="display: flex; flex-wrap: wrap; justify-content: center;">
  @if ($posts->answer == "unsolved")
  <div class="comment">
    <form action="/comments">
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Comments</label>
      <input type="text" style="display: none;" name="id" value="{{ $posts->uuid }}"/>
      <input type="text" style="display: none;" name="title" value="{{ $posts->title }}"/>
      <input type="text" style="display: none;" name="postauthor" value="{{ $posts->author }}"/>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comments"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  @else
  @endif
  @foreach ($comment as $comments)
@if ($posts->answer == "solved")
   <div class="content">
@endif
  <div class="comments">
    <div class="upload" style="background-color: lightblue; padding: 20px;">
      @if ($posts->answer == "solved" && $comments->solving == "correct")
      <button class="btn" style="background-color: aqua; margin-bottom: 20px;">{{ $comments->solving }}</button>
      @else
      @endif
      <div class="profile" style="display: flex; align-items: center;">
    <div class="profile" style="display: flex; align-items: center; width: 7cm;">
      <img src="{{ $comments->profile_author }}" style="height: 20px; width: 20px; margin-right: 10px; margin-bottom: 20px;" />
      <small style="height: 20px; margin-bottom: 20px;" >{{ $comments->author }}</small>
      @if ($comments->author != Auth::user()->name && $posts->author == Auth::user()->name && $posts->answer == "unsolved" && $posts->typepost != "discussion")
      <button class="btn" style="background-color: aquamarine; margin: 20px;" onclick="window.location.href = '/solvedproblem/?uuidreply={{ $comments->uuidreply }}&uuid={{ $posts->uuid }}&name={{ $comments->author }}&profile={{ $comments->profile_author }}'">Correct</button>
      @else
      @endif
      @if (Auth::user()->role == "admin")
      <div class="delete" style="display: flex; align-items: center;">  
        <button class="btn delete" style="background-color: red;" onclick="window.location.href = '/deletecomment?uuid={{ $comments->uuid }}&uuidreply={{ $comments->uuidreply }}'">Delete</button>
      </div>
      @else
      @if (Auth::user()->name == $comments->author && $posts->answer != "solved")
      <div class="delete" style="display: flex; align-items: center;">  
        <button class="btn delete" style="background-color: red;" onclick="window.location.href = '/deletecomment?uuid={{ $comments->uuid }}&uuidreply={{ $comments->uuidreply }}'">Delete</button>
      </div>
      @endif
      @endif
      </div>
    </div>
  <p>{{ $comments->comment }}</p>
  <small> {{ $comments->comment_date }}</small>
  <div>
  <small id="btnreplyclosed" style="display: none;">Replying</small>
  </div>
  @if ($posts->answer == "unsolved")
<div class="commentreply" id="replying">
  <form action="/reply">
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Reply</label>
    <input type="text" style="display: none;" name="idpost" value="{{ $comments->uuid }}"/>
    <input type="text" style="display: none;" name="id" value="{{ $comments->uuidreply }}"/>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comments"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@else
@endif
  @foreach ($reply as $replying)
@if ($replying->uuid == $comments->uuidreply)
<div class="replying">
  @if ($posts->answer == "solved" && $replying->solving == "correct")
  <button class="btn" style="background-color: aqua; margin-bottom: 20px;">{{ $replying->solving }}</button>
  @else
  @endif
  <div class="upload" style="display: flex; align-items: center; width: 100%;">
    <div class="profile" style="display: flex; align-items: center; width: 7cm;">
    <img src="{{ $replying->profile_author }}" style="height: 20px; width: 20px; margin-right: 10px; margin-bottom: 20px;" />
    <small style="height: 20px; margin-bottom: 20px;">{{ $replying->author }}</small>
    @if ($replying->author != Auth::user()->name && $posts->author == Auth::user()->name && $posts->answer == "unsolved" && $posts->typepost != "discussion")
    <button class="btn" style="background-color: aquamarine; margin: 20px;" onclick="window.location.href = '/solvedproblem?uuidreply={{ $replying->uuidreply }}&uuid={{ $posts->uuid }}&name={{ $comments->author }}&profile={{ $comments->profile_author }}'">Correct</button>
    @else
    @endif
    @if(Auth::user()->role == "admin")
    <div class="delete" style="display: flex; align-items: center;">
      <button class="btn delete" style="background-color: red;" onclick="window.location.href = '/deletereply?uuid={{ $comments->uuid }}&uuidreply={{ $replying->uuidreply }}'">Delete</button>
    </div>
    @else
    @if(Auth::user()->name == $replying->author && $posts->answer != "solved")
    <div class="delete" style="display: flex; align-items: center;">
      <button class="btn delete" style="background-color: red;" onclick="window.location.href = '/deletereply?uuid={{ $comments->uuid }}&uuidreply={{ $replying->uuidreply }}'">Delete</button>
    </div>
    @endif
    @endif
  </div>
  </div>
<p>{{ $replying->comment }}</p>
<small>{{ $replying->reply_date }}</small>
</div>
@else
@endif
@endforeach
</div>
</div>
@endforeach
  </div>
  </div>
  @endforeach
   <style>
    .comments{
      margin-left: 20px;
      margin-top: 1cm;
      width: 18cm;

    }
    .post{
      background-color: #89a8e3f5;
      height: max-content;
      padding: 20px;
      margin: 20px;
      border-radius: 20px;
      width: 20cm;
    }
    .comment{
      background-color: white;
      height: max-content;
      padding: 20px;
      width: 20cm;
    }
    .replying{
      margin-left: 1cm;
      margin-top: 1cm;
    }
    .commentreply{
      height: max-content;
      padding: 20px;
      width: 15cm;
    }
    .delete{
      margin-left: 20%;
      color: white;
    }
    @media only screen and (max-width: 600px) {
      .post{
        width: 13cm;
      }
      .comment{
        width: 13cm; 
      }
      .commentreply{
        background-color: #89a8e3f5;
        height: max-content;
        padding: 20px;
        width: 12cm;
    }
    }
    </style>
</body>
</html>
