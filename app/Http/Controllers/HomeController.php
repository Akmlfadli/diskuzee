<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        if (Auth::user()->name){
            // Query untuk mendapatkan 3 postingan dengan komentar terbanyak
            $trending = DB::select("
                SELECT title AS posts, uuid, postauthor, COUNT(title) AS mostcomments 
                FROM comments 
                GROUP BY title, uuid, postauthor
                ORDER BY mostcomments DESC 
                LIMIT 3
            ");
    
            // Mengambil semua postingan
            $results = DB::select("SELECT * FROM posts");
    
            // Mengirim data ke view
            return view('home', [
                "contents" => $results, 
                "trending" => $trending
            ]);
        } else {
            return redirect()->to('/login');
        }
    }
}
?>