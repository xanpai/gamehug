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
            return view('watch.download-not-found');
        }

        $download = PostVideo::find($id);

        if (!$download) {
            return view('watch.download-not-found');
        }

        // Fetch the associated Post (listing)
        $listing = Post::find($download->postable_id);

        if (!$listing) {
            return view('watch.download-not-found');
        }

        return view('watch.download', compact('download', 'listing'));
    }
}
