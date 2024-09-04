<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class RecentPostsController extends Controller
{
    public function index()
    {
        $recentPosts = Post::orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('watch.recent_posts', compact('recentPosts'));
    }
}
