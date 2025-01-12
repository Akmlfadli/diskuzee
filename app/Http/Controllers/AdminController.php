<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function usersshow(){
        // Fetch users data from the 'users' table
        $results = DB::select("SELECT * FROM users");
    
        // Fetch top 3 trending posts based on the number of comments
        $trending = DB::select("
        SELECT title AS posts, uuid, postauthor, COUNT(title) AS mostcomments 
        FROM comments 
        GROUP BY title, uuid, postauthor
        ORDER BY mostcomments DESC 
        LIMIT 3
    ");
    $uploadby = DB::select("
    SELECT title AS posts, author, COUNT(title) AS mostcomments
    FROM comments 
    GROUP BY title, author
    ORDER BY mostcomments DESC 
    LIMIT 3
");

        // Fetch reports data from the 'reports' table
        $result = DB::select("SELECT * FROM reports");
    
        // Return view with the necessary data passed
        return view('admin.users', [
            'users' => $results,
            'reports' => $result,
            'trending' => $trending,
            'uploadby' => $uploadby,
        ]);
    }
    

    public function report(Request $request){
        $uuid = $request->query('uuid');
        $name = $request->query('name');
        $profile = $request->query('profile');
        $title = $request->query('title');
        $deskripsi = $request->query('deskripsi');

        return view('deleteposts', ['uuid'=>$uuid, 'name'=>$name, 'profile'=>$profile, 'title'=>$title, 'deskripsi'=>$deskripsi]);
    }


    public function reportstore(Request $request){
        $uuid = $request->query('uuid');
        $name = $request->query('name');
        $profile = $request->query('profile');
        $title = $request->query('title');
        $deskripsi = $request->query('deskripsi');
        $alasan = $request->query('alasan');

        $result = DB::insert("INSERT INTO reports (uuid, name, profile, title, deskripsi, alasan) VALUES (?, ?, ?, ?, ?, ?)", [$uuid, $name, $profile, $title, $deskripsi, $alasan]);
        if($result){
            return redirect()->to('/home');
        }
    }

    public function usersdelete(Request $request){
        $id = $request->query('id');

        DB::table('users')->where('id', $id)->delete();
        return redirect()->to('/administrator');
    }

    public function postsdelete(Request $request){
        $uuid = $request->query('uuid');

        DB::table('comments')->where('uuid', $uuid)->delete();
        DB::table('reply')->where('uuidreply', $uuid)->delete();
        DB::table('posts')->where('uuid', $uuid)->delete();
        DB::table('reports')->where('uuid', $uuid)->delete();

        return redirect()->to('/administrator');
    }
}
