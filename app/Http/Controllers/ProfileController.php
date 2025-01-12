<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        DB::table('comments')->where('author', Auth::user()->name)->delete();
        DB::table('reply')->where('author', Auth::user()->name)->delete();
        DB::table('posts')->where('author', Auth::user()->name)->delete();
        
        if ($request->hasFile('profile')) {
            $uuid = Str::uuid()->toString();
            $newImagePath = $uuid  .  " - " .  $request->file('profile')->getClientOriginalName();
            $request->profile->move(public_path('images/profile'), $newImagePath);
            if (Auth::user()->profile_picture != '/images/profile/default.jpeg'){
               File::delete(public_path(Auth::user()->profile_picture));
            }
            DB::update("UPDATE users SET profile_picture = ? WHERE id = ?", ["/images/profile/" . $newImagePath, Auth::user()->id]);
        }  

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }  

        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();


        if (Auth::user()->profile_picture != '/images/profile/default.jpeg'){
            File::delete(public_path(Auth::user()->profile_picture));
        }

        Auth::logout();

        DB::table('comments')->where('author', Auth::user()->name)->delete();
        DB::table('reply')->where('author', Auth::user()->name)->delete();
        DB::table('posts')->where('author', Auth::user()->name)->delete();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
