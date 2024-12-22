<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container my-4">
        <!-- Post Container -->
        <div class="post bg-light p-4 rounded shadow-sm">
            <button class="btn btn-primary mb-3" onclick="window.location.href = '/home'">Back</button>
            @foreach ($post as $posts)
                <div class="profile d-flex align-items-center mb-4">
                    <img src="{{ $posts->profile_author }}" class="rounded-circle" style="height: 50px; width: 50px; margin-right: 10px;">
                    <h1 class="h4 mb-0">{{ $posts->author }}</h1>
                </div>
                <h2 class="h3 mb-3">{{ $posts->title }}</h2>
                <p>{{ $posts->deskripsi }}</p>

                <!-- Images (if any) -->
                @if ($posts->image1)
                    <div class="text-center mb-3">
                        <img src="{{ $posts->image1 }}" class="img-fluid" style="max-height: 500px; max-width: 100%;">
                    </div>
                @endif
                @if ($posts->image2)
                    <div class="text-center mb-3">
                        <img src="{{ $posts->image2 }}" class="img-fluid" style="max-height: 500px; max-width: 100%;">
                    </div>
                @endif
                @if ($posts->image3)
                    <div class="text-center mb-3">
                        <img src="{{ $posts->image3 }}" class="img-fluid" style="max-height: 500px; max-width: 100%;">
                    </div>
                @endif

                <small class="text-muted">{{ $posts->upload_date }}</small>
            @endforeach
        </div>

        <!-- Comments Section -->
        <div class="comments-section mt-4">
            @if ($posts->answer == "unsolved")
                <div class="comment bg-white p-4 rounded shadow-sm">
                    <form action="/comments">
                        <div class="mb-3">
                            <label for="commentText" class="form-label">Comments</label>
                            <input type="hidden" name="id" value="{{ $posts->uuid }}" />
                            <input type="hidden" name="title" value="{{ $posts->title }}" />
                            <input type="hidden" name="postauthor" value="{{ $posts->author }}" />
                            <textarea class="form-control" id="commentText" rows="3" name="comments"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            @endif

            <!-- Loop through Comments -->
            @foreach ($comment as $comments)
                <div class="comment-content bg-light p-4 mt-3 rounded shadow-sm">
                    <!-- If Solved -->
                    @if ($posts->answer == "solved" && $comments->solving == "correct")
                        <button class="btn btn-info mb-3">{{ $comments->solving }}</button>
                    @endif
                    <div class="d-flex align-items-center">
                        <img src="{{ $comments->profile_author }}" class="rounded-circle" style="height: 30px; width: 30px; margin-right: 10px;">
                        <small>{{ $comments->author }}</small>

                        @if ($comments->author != Auth::user()->name && $posts->author == Auth::user()->name && $posts->answer == "unsolved" && $posts->typepost != "discussion")
                            <button class="btn btn-success ms-3" onclick="window.location.href = '/solvedproblem/?uuidreply={{ $comments->uuidreply }}&uuid={{ $posts->uuid }}&name={{ $comments->author }}&profile={{ $comments->profile_author }}'">Correct</button>
                        @endif

                        <!-- Admin and Author Permissions -->
                        @if (Auth::user()->role == "admin")
                            <div class="ms-auto">
                                <button class="btn btn-danger" onclick="window.location.href = '/deletecomment?uuid={{ $comments->uuid }}&uuidreply={{ $comments->uuidreply }}'">Delete</button>
                            </div>
                        @elseif (Auth::user()->name == $comments->author && $posts->answer != "solved")
                            <div class="ms-auto">
                                <button class="btn btn-danger" onclick="window.location.href = '/deletecomment?uuid={{ $comments->uuid }}&uuidreply={{ $comments->uuidreply }}'">Delete</button>
                            </div>
                        @endif
                    </div>
                    <p>{{ $comments->comment }}</p>
                    <small class="text-muted">{{ $comments->comment_date }}</small>

                    <!-- Reply Section -->
                    @if ($posts->answer == "unsolved")
                        <div class="comment-reply mt-3">
                            <form action="/reply">
                                <div class="mb-3">
                                    <label for="replyText" class="form-label">Reply</label>
                                    <input type="hidden" name="idpost" value="{{ $comments->uuid }}" />
                                    <input type="hidden" name="id" value="{{ $comments->uuidreply }}" />
                                    <textarea class="form-control" id="replyText" rows="3" name="comments"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    @endif

                    <!-- Loop through Replies -->
                    @foreach ($reply as $replying)
                        @if ($replying->uuid == $comments->uuidreply)
                            <div class="reply bg-light p-3 mt-2 rounded">
                                <!-- Solved State for Reply -->
                                @if ($posts->answer == "solved" && $replying->solving == "correct")
                                    <button class="btn btn-info mb-3">{{ $replying->solving }}</button>
                                @endif
                                <div class="d-flex align-items-center">
                                    <img src="{{ $replying->profile_author }}" class="rounded-circle" style="height: 30px; width: 30px; margin-right: 10px;">
                                    <small>{{ $replying->author }}</small>

                                    @if ($replying->author != Auth::user()->name && $posts->author == Auth::user()->name && $posts->answer == "unsolved" && $posts->typepost != "discussion")
                                        <button class="btn btn-success ms-3" onclick="window.location.href = '/solvedproblem?uuidreply={{ $replying->uuidreply }}&uuid={{ $posts->uuid }}&name={{ $comments->author }}&profile={{ $comments->profile_author }}'">Correct</button>
                                    @endif

                                    <!-- Admin and Author Permissions for Reply -->
                                    @if (Auth::user()->role == "admin")
                                        <div class="ms-auto">
                                            <button class="btn btn-danger" onclick="window.location.href = '/deletereply?uuid={{ $comments->uuid }}&uuidreply={{ $replying->uuidreply }}'">Delete</button>
                                        </div>
                                    @elseif(Auth::user()->name == $replying->author && $posts->answer != "solved")
                                        <div class="ms-auto">
                                            <button class="btn btn-danger" onclick="window.location.href = '/deletereply?uuid={{ $comments->uuid }}&uuidreply={{ $replying->uuidreply }}'">Delete</button>
                                        </div>
                                    @endif
                                </div>
                                <p>{{ $replying->comment }}</p>
                                <small class="text-muted">{{ $replying->reply_date }}</small>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <style>
        /* General Styles */
        .comments {
            margin-left: 20px;
            margin-top: 1cm;
        }

        .post {
            background-color: #f1f3f5;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
        }

        .comment {
            background-color: white;
            padding: 20px;
            margin-top: 15px;
            border-radius: 8px;
        }

        .comment-reply {
            margin-top: 1.5cm;
        }

        .reply {
            margin-left: 2cm;
            padding: 10px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .delete {
            margin-left: 20%;
            color: white;
        }

        /* Mobile responsiveness */
        @media only screen and (max-width: 600px) {
            .post {
                width: 100%;
            }

            .comment {
                width: 100%;
            }

            .commentreply {
                background-color: #f1f3f5;
                width: 100%;
            }
        }
    </style>
</body>
</html>
