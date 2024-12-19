<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function add(Request $request){
        $uuid = $request->query('uuid');
        $name = $request->query('name');
        $profile = $request->query('profile');

        $request = DB::insert("INSERT INTO top_users(name, profile) VALUES (?, ?)", [$name, $profile]); 
        $closed = DB::update("UPDATE posts SET answer = ? WHERE uuid = ?", ["solved", $uuid]);

        if ($request && $closed){
            return redirect()->to('/posts/topic/' . $uuid);
        }
    }
}
