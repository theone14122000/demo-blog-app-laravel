<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * SHOW EDIT PROFILE PAGE
     */
    public function edit(): View
    {
        return view('profile.edit');
    }

    /**
     * UPDATE PROFILE
     */
    public function update(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable|max:1000',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // UPDATE NAME + BIO
        $user->name = $request->name;
        $user->bio = $request->bio;

        // HANDLE IMAGE UPLOAD
        if ($request->hasFile('avatar')) {

            $path = $request->file('avatar')
                            ->store('avatars', 'public');

            $user->avatar = $path;
        }

        $user->save();

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * DELETE ACCOUNT
     */
    public function destroy(Request $request): RedirectResponse
    {

        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * SHOW PROFILE PAGE
     */
    public function show()
    {

        $user = Auth::user();

        // LOAD POSTS + RELATIONSHIPS
        $posts = $user->posts()
                      ->with('likes', 'comments')
                      ->latest()
                      ->get();

        // STATS
        $postsCount = $posts->count();

        $likesCount = $posts->sum(function ($post) {
            return $post->likes->count();
        });

        $commentsCount = $posts->sum(function ($post) {
            return $post->comments->count();
        });

        return view('profile.show', compact(
            'user',
            'posts',
            'postsCount',
            'likesCount',
            'commentsCount'
        ));
    }

}