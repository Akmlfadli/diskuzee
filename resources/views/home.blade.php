<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<title>DiskuZee</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi, {{ Auth::user()->name  }}
            <button></button>
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex; flex-wrap: wrap;">
                    <div class="container">
                        <div class="search-bar">
                            <form action="/search" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="search-addon" name="query">
                                <button class="btn btn-outline-secondary" type="submit" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="container">
            <h1 class="text-center mb-5" style="font-size: 2rem; font-weight: bold; color: #333;">Top Trending</h1>
            
            <!-- List group to display trending posts -->
            <div class="list-group">
                @foreach ($trending as $trendings)
                @if ($trendings->posts != "")
                    <a href="/posts/topic/{{ $trendings->uuid }}" class="list-group-item list-group-item-action list-group-item-light shadow-sm rounded-lg mb-3 hover-effect">
                        <i class="fas fa-fire text-danger me-3"></i> 
                         {{ $trendings->posts }} - 
                         Post by {{ $trendings->postauthor }}
                        <span class="badge bg-info ms-3">{{ $trendings->mostcomments }} Comments</span>
                    </a>
                @else
                @endif
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Custom CSS for hover effect -->
    <style>
        .hover-effect:hover {
            background-color: #f8d7da;
            transform: translateY(-5px);
            transition: all 0.3s ease-in-out;
        }
    </style>
    
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex; justify-content: space-around; flex-wrap: wrap;">
                    <div class="contents" id="search-results" class="search-results" style="height: max-content;">
                        @if ($contents)
                        @foreach ($contents as $content)
                        <div style="height: max-content; width: 100%; margin: 20px; background-color: #89a8e3f5; padding: 20px;">
                           <div class="title" style="display: flex; justify-content: space-between;">
                           <div style="display: flex; flex-wrap: wrap;">
                           <h1 style="font-size: 30px;"> {{ $content->title }} </h1>
                           </div>
                            <a href="report?uuid={{ $content->uuid }}&name={{ $content->author }}&profile={{ $content->profile_author }}&title={{ $content->title }}&deskripsi={{ $content->deskripsi }}">Report</a>
                           </div>
                           <div class="click" onclick="window.location.href = '/posts/topic/{{ $content->uuid }}'">
                           <div style="display: flex; justify-content: start;">
                           <small style="margin-bottom: 30px; margin-right: 10px;">Upload By  {{ $content->author }} </small>
                           <img src="{{ $content->profile_author }}" style="height: 20px; width: 20px;"/>
                           </div>
                           <p> {{ $content->deskripsi }} </p>
                           <img src="{{ $content->image1 }}" />
                           <img src="{{ $content->image2 }}" />
                           <img src="{{ $content->image3 }}" />
                           <small>{{ $content->upload_date }}</small>
                        </div></br>
                        @if ($content->typepost == "discussion")
                        @if (Auth::user()->role == "admin" or Auth::user()->name == $content->author)
                        <div style="display: flex; justify-content: space-between;">
                            <button class="btn" style="background-color: red" onclick="window.location.href = '/delete/posts?query={{ $content->uuid }}'">Delete</button>
                        </div>
                        @endif
                        @else
                        @if (Auth::user()->role == "admin")
                        <div style="display: flex; justify-content: space-between;">
                        <button class="btn" style="background-color: red" onclick="window.location.href = '/delete/posts?query={{ $content->uuid }}'">Delete</button>
                        @if ($content->answer == "solved")
                        <button class="btn" style="background-color: lightblue;">{{ $content->answer }}</button>
                        @else
                        <button class="btn" style="background-color: orange;">{{ $content->answer }}</button>
                        @endif
                        </div>
                        @else
                        @if (Auth::user()->name == $content->author)
                        <div style="display: flex; justify-content: space-between;">
                        <button class="btn" style="background-color: red" onclick="window.location.href = '/delete/posts?query={{ $content->uuid }}'">Delete</button>
                        <div>
                          @if($content->answer == "solved")
                          <button class="btn" style="background-color: lightblue;">{{ $content->answer }}</button>
                          @else
                          <button class="btn" style="background-color: orange;">{{ $content->answer }}</button>
                          @endif
                        </div>
                        </div>
                        @else
                        <div>
                            @if($content->answer == "solved")
                            <button class="btn" style="background-color: lightblue;">{{ $content->answer }}</button>
                            @else
                            <button class="btn" style="background-color: orange;">{{ $content->answer }}</button>
                            @endif
                        </div>
                        @endif
                        @endif
                        @endif
                        </div>
                        @endforeach
                        @else
                        @endif
                    </div>
                    <div class="contentsmobile" style="height: max-content;">
                        @if ($contents)
                        @foreach ($contents as $content)
                        <div style="height: max-content; width: 100%; margin: 20px; background-color: #89a8e3f5; padding: 20px;">
                           <div class="title" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                           <h1 style="font-size: 30px;"> {{ $content->title }} </h1>     <a href="report?uuid={{ $content->uuid }}&name={{ $content->author }}&profile={{ $content->profile_author }}&title={{ $content->title }}&deskripsi={{ $content->deskripsi }}">Report</a>
                           </div>
                           <div class="click" onclick="window.location.href = '/posts/topic/{{ $content->uuid }}'">
                           <div style="display: flex; justify-content: start;">
                           <small style="margin-bottom: 30px; margin-right: 10px;">Upload By  {{ $content->author }} </small>
                           <img src="{{ $content->profile_author }}" style="height: 20px; width: 20px;"/>
                           </div>
                           <p> {{ $content->deskripsi }} </p>
                           <img src="{{ $content->image1 }}" />
                           <img src="{{ $content->image2 }}" />
                           <img src="{{ $content->image3 }}" />
                           <small>{{ $content->upload_date }}</small>
                        </div></br>
                        @if ($content->typepost == "discussion")
                        @if (Auth::user()->role == "admin" or Auth::user()->name == $content->author)
                        <div style="display: flex; justify-content: space-between;">
                            <button class="btn" style="background-color: red" onclick="window.location.href = '/delete/posts?query={{ $content->uuid }}'">Delete</button>
                        </div>
                        @endif
                        @else
                        @if (Auth::user()->role == "admin")
                        <div style="display: flex; justify-content: space-between;">
                        <button class="btn" style="background-color: red" onclick="window.location.href = '/delete/posts?query={{ $content->uuid }}'">Delete</button>
                        <div>
                            @if($content->answer == "solved")
                            <button class="btn" style="background-color: lightblue;">{{ $content->answer }}</button>
                            @else
                            <button class="btn" style="background-color: orange;">{{ $content->answer }}</button>
                            @endif
                        </div>
                        </div>
                        @else
                        @if (Auth::user()->name == $content->author)
                        <div style="display: flex; justify-content: space-between;">
                        <button class="btn" style="background-color: red" onclick="window.location.href = '/delete/posts?query={{ $content->uuid }}'">Delete</button>
                        <div>
                            @if($content->answer == "solved")
                            <button class="btn" style="background-color: lightblue;">{{ $content->answer }}</button>
                            @else
                            <button class="btn" style="background-color: orange;">{{ $content->answer }}</button>
                            @endif
                        </div>
                        </div>
                        @else
                        <div>
                            @if($content->answer == "solved")
                            <button class="btn" style="background-color: lightblue;">{{ $content->answer }}</button>
                            @else
                            <button class="btn" style="background-color: orange;">{{ $content->answer }}</button>
                            @endif
                        </div>
                        @endif
                        @endif
                        @endif
                        </div>
                        @endforeach
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .search-bar {
    max-width: 500px;
    margin: auto auto;
}

.search-bar .input-group {
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.search-bar .form-control {
    border: none;
    padding-left: 20px;
}

.search-bar .btn {
    border: none;
    padding: 10px 20px;
}

        .trendingmobile{
            display: none;
        }

        .inputmobile{
            display: none;
        }

        .contents{
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            height: max-content;
            width: 65%;
            background-color: #e4eaf5f5;
            border-radius: 20px;
        }

        .contentsmobile{
            display: none;
        }
        @media only screen and (max-width: 600px) {
            .trending{
                display: none;
            }
            .input{
                display: none;
            }
            .contents{
                display: none;
            }

            .inputmobile{
                display: block;
            }
            .contentsmobile{
                display: flex;
                justify-content: space-evenly;
                flex-wrap: wrap;
                height: max-content;
                width: 100%;
                background-color: #e4eaf5f5;
                border-radius: 20px;
            }
            .trendingmobile{
                display: block;
            }
        }
    </style>
</x-app-layout>
