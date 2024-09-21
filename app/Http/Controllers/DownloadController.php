<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\Post;
use App\Models\PostEpisode;
use App\Models\PostVideo;
use Illuminate\Http\Request;
use App\Models\Log;

class DownloadController extends Controller
{
    public function initiate($id)
    {
        session(['download_id' => $id]);
        return redirect()->route('download.page');
    }

    public function show(Request $request)
    {
        $id = session('download_id');
        session()->forget('download_id');

        if (!$id) {
            return $this->handleNoDownload('Download ID not found');
        }

        $download = PostVideo::find($id);

        if (!$download) {
            return $this->handleNoDownload('Download not found');
        }

        // Fetch the associated Post (listing)
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
