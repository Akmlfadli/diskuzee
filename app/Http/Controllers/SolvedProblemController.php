<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SolvedProblemController extends Controller
{
    public function add(Request $request){
        $uuid = $request->query('uuid');
        $uuidreply = $request->query('uuidreply');
        $name = $request->query('name');

        $request = DB::update("UPDATE comments SET solving = ? WHERE uuidreply = ?", ["correct", $uuidreply]);
        $requests = DB::update("UPDATE reply SET solving = ? WHERE uuidreply = ?", ["correct", $uuidreply]); 
        $closed = DB::update("UPDATE posts SET answer = ? WHERE uuid = ?", ["solved", $uuid]);
            return redirect()->to('/posts/topic/' . $uuid);
    }
}
