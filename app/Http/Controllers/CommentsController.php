<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request){
        $uuid = $request->query('id');
        $postsauthor = $request->query('postauthor');
        $comment = $request->query('comments');
        $title = $request->query('title');
        $current_time = Carbon::now('Asia/Jakarta');
        
        if (!$comment or !$title){
            return redirect()->to('/posts/topic/' . $uuid);
        }


        $authorbypass = DB::table('comments')->where('postauthor', Auth::user()->name)->where('uuid', $uuid)->count();

        if ($authorbypass > 0){
        $uuidreply = Str::uuid()->toString();
        $result = DB::insert("INSERT INTO comments(uuid, postauthor, uuidreply, author, profile_author, comment, comment_date) VALUES (?, ?, ?, ?, ?, ?, ?)", [$uuid, $postsauthor, $uuidreply, Auth::user()->name, Auth::user()->profile_picture, $comment, $current_time]);
        return redirect()->to('/posts/topic/' . $uuid);
        
        }
        $uuidreply = Str::uuid()->toString();
        $results = DB::insert("INSERT INTO comments(uuid, postauthor, uuidreply, author, profile_author, title, comment, comment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [$uuid, $postsauthor, $uuidreply, Auth::user()->name, Auth::user()->profile_picture, $title, $comment, $current_time]);
        if ($results){
            return redirect()->to('/posts/topic/' . $uuid);
        }
    }

    public function storereply(Request $request){
        $current_time = Carbon::now('Asia/Jakarta');
        $back = $request->query('idpost');
        $uuid = $request->query('id');
        $reply = $request->query('comments');

        if (!$reply){
            return redirect()->to('/posts/topic/' . $uuid);
        }
        $uuidreply = Str::uuid()->toString();
        $results = DB::insert("INSERT INTO reply(uuid, uuidreply, author, profile_author, comment, reply_date) VALUES (?, ?, ?, ?, ?, ?)", [$uuid, $uuidreply, Auth::user()->name, Auth::user()->profile_picture, $reply, $current_time]);

        if ($results){
            return redirect()->to("/posts/topic/" . $back);
        }
    }

    public function deletecomment(Request $request){
        $uuid = $request->query('uuid');
        $uuidreply = $request->query('uuidreply');

        $results = DB::table('comments')->where('uuidreply', $uuidreply)->delete();
        DB::table('reply')->where('uuid', $uuidreply)->delete();

        return redirect()->to('/posts/topic/' . $uuid);
    }

    public function deletereply(Request $request){
        $uuid = $request->query('uuid');
        $uuidreply = $request->query('uuidreply');

        $result = DB::table('reply')->where('uuidreply', $uuidreply)->delete();

        if ($result){
            return redirect()->to('/posts/topic/' . $uuid);
        }
        else{
            return redirect()->to('/error');
        }
    }
}
