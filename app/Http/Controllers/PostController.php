<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function store(Request $request){
        $title = $request->request->get('title');
	$deskripsi = $request->request->get('deskripsi');
	$typepost = $request->request->get('typepost');
        $uuid = Str::uuid()->toString();
        $uuid1 = Str::uuid()->toString();
        $uuid2 = Str::uuid()->toString();
        $uuid3 = Str::uuid()->toString();


        DB::insert("INSERT INTO posts(uuid, typepost) VALUE (?, ?)", [$uuid, $typepost]);

        if ($request->file('image1')){
            $image1_sv = $uuid1 . " - " . $request->file('image1')->getClientOriginalName();
            $image1 = "/images/uploads/" . $uuid1 . " - " . $request->file('image1')->getClientOriginalName();
            $request->image1->move(public_path('/images/uploads'), $image1_sv);
            $result = DB::update("UPDATE posts SET image1 = ? WHERE uuid = ?", [$image1, $uuid]);
        }
            
        if ($request->file('image2')){
            $image2_sv = $uuid2 . " - " . $request->file('image2')->getClientOriginalName();
            $image2 = "/images/uploads/" . $uuid2 . " - " . $request->file('image2')->getClientOriginalName();
            $request->image2->move(public_path('/images/uploads'), $image2_sv);
            $result = DB::update("UPDATE posts SET image2 = ? WHERE uuid = ?", [$image2, $uuid]);

        }

        if ($request->file('image3')){
            $image3_sv = $uuid3 . " - " . $request->file('image3')->getClientOriginalName();
            $image3 = "/images/uploads/" . $uuid3 . " - " . $request->file('image3')->getClientOriginalName();
            $request->image3->move(public_path('/images/uploads'), $image3_sv);
            $result = DB::update("UPDATE posts SET image3 = ? WHERE uuid = ?", [$image3, $uuid]);

        }

        $current_time = Carbon::now('Asia/Jakarta');

        $results = DB::insert("UPDATE posts SET title = ?,  author = ?, profile_author = ?,  deskripsi = ?, upload_date = ? WHERE uuid = ?", [$title, Auth::user()->name, Auth::user()->profile_picture, $deskripsi, $current_time, $uuid]);
         
        if ($results){
          return redirect()->to('/home');
        }
    }

    public function show($uuid){
        $results = DB::select("SELECT * FROM posts WHERE uuid = ?", [$uuid]);
        $result = DB::select("SELECT * FROM comments WHERE uuid = ?", [$uuid]);
        $reply = DB::select("SELECT * FROM reply", []);

        return view('posts.index', ["post" => $results, "comment" => $result, "reply" => $reply]);
    }

    public function delete(Request $request){
        $input = $request->query('query');  
        $results = DB::table("posts")->where("uuid", $input)->delete();
        $results = DB::table("comments")->where("uuid", $input)->delete();
            return redirect()->to('/home');
    }
    }
