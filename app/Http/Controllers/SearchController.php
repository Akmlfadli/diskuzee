<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        if($request->query('query')){
        $query = "%" . $request->query('query') . "%";
        $result = DB::select("SELECT * FROM posts WHERE title LIKE ?", [$query]);
        return view('search', ["contents" => $result, "cari" => $request->query('query')]);
        }
        else{
            return redirect()->to('/home');
        }
        
    }
}
