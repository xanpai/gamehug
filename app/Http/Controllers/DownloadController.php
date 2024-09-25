<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class DownloadController extends Controller
{
    public function generateToken($id)
    {
        $token = Str::random(40);
        $expiresAt = now()->addMinutes(15);

        Cache::put("download_token:{$token}", $id, $expiresAt);

        return response()->json(['token' => $token]);
    }

    public function initiate($token)
    {
        $id = Cache::get("download_token:{$token}");

        if (!$id) {
            return $this->handleNoDownload('Invalid or expired download token');
        }

        Cache::forget("download_token:{$token}");

        $download = PostVideo::find($id);

        if (!$download) {
            return $this->handleNoDownload('Download not found');
        }

        $listing = Post::find($download->postable_id);

        if (!$listing) {
            return $this->handleNoDownload('Associated listing not found');
        }

        $config = [
            'title' => config('settings.download_title'),
            'description' => config('settings.download_description'),
        ];

        return view('watch.download', compact('download', 'listing', 'config'));
    }

    private function handleNoDownload($reason)
    {
        $config = [
            'title' => config('settings.nodownload_title'),
            'description' => config('settings.nodownload_description'),
        ];

        return view('watch.download-not-found', compact('config', 'reason'));
    }
}
