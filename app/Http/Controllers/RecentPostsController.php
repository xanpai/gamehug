<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RecentPostsController extends Controller
{
    public function index()
    {
        $endDate = Carbon::now()->endOfDay();
        $startDate = Carbon::now()->subDays(6)->startOfDay();

        $recentPosts = Post::where('status', 'publish')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->updated_at)->format('Y-m-d');
            });

        $config = [
            'title' => config('settings.recent_title'),
            'description' => config('settings.recent_description'),
            'route' => 'recent-posts',
            'nav' => 'recent-posts',
        ];

        return view('watch.recent_posts', compact('recentPosts', 'config'));
    }
}
