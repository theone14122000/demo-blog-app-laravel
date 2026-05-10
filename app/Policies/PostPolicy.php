<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    /**
     * Anyone logged in can view posts
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Anyone logged in can view single post
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Any logged in user can create posts
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * User can update own post
     * Admin can update any post
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || $user->is_admin;
    }

    /**
     * User can delete own post
     * Admin can delete any post
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || $user->is_admin;
    }
}