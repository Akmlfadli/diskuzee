<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
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
        $image1 = $request->query('image1');
        $image2 = $request->query('image2');
        $image3 = $request->query('image3');

        return view('deleteposts', ['uuid'=>$uuid, 'name'=>$name, 'profile'=>$profile, 'title'=>$title, 'deskripsi'=>$deskripsi, 'image1'=>$image1, 'image2'=>$image2, 'image3'=>$image3]);
    }


    public function reportstore(Request $request){
        $uuid = $request->query('uuid');
        $name = $request->query('name');
        $profile = $request->query('profile');
        $title = $request->query('title');
        $deskripsi = $request->query('deskripsi');
        $image1 = $request->query('image1');
        $image2 = $request->query('image2');
        $image3 = $request->query('image3');
        $alasan = $request->query('alasan');

        $result = DB::insert("INSERT INTO reports (uuid, name, profile, title, deskripsi, image1, image2, image3, alasan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", [$uuid, $name, $profile, $title, $deskripsi, $image1, $image2, $image3, $alasan]);
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
        $image1 = $request->query('image1');
        $image2 = $request->query('image2');
        $image3 = $request->query('image3');

        DB::table('comments')->where('uuid', $uuid)->delete();
        DB::table('reply')->where('uuid', $uuid)->delete();
        DB::table('posts')->where('uuid', $uuid)->delete();
        DB::table('reports')->where('uuid', $uuid)->delete();
        File::delete(public_path($image1));
        File::delete(public_path($image2));
        File::delete(public_path($image3));
        
        return redirect()->to('/administrator');
    }
}
