<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user)
    {
        // Admins and moderators can view posts
        return $user->isAdmin() || $user->isModerator();
    }

    public function view(User $user, Post $post)
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Moderators can view their own posts
        return $user->isModerator() && $post->user_id == $user->id;
    }

    public function create(User $user)
    {
        // Admins and moderators can create posts
        return $user->isAdmin() || $user->isModerator();
    }

    public function update(User $user, Post $post)
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Moderators can update their own posts
        return $user->isModerator() && $post->user_id == $user->id;
    }

    public function delete(User $user, Post $post)
    {
        // Only admins can delete posts
        return $user->isAdmin();
    }


    public function publish(User $user)
    {
        // Only admins can publish posts
        return $user->isAdmin();
    }
}
