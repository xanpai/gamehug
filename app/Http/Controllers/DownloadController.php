<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class DownloadController extends Controller
{
    public function generateToken(Request $request, $id)
    {
        // Generate a unique token
        $token = Str::random(40);
        $expiresAt = now()->addMinutes(15);

        $score = RecaptchaV3::verify($request->get('g-recaptcha-response'), 'download');
        if ($score < 0.5) {
            return response()->json(['error' => 'Something went wrong. Please try again.']);
        }

        // Store the token and associated download ID in the cache
        Cache::put("download_token:{$token}", $id, $expiresAt);

        // Return the token as JSON response
        return response()->json(['token' => $token]);
    }

    public function initiate($token)
    {
        // Retrieve the download ID associated with the token
        $id = Cache::get("download_token:{$token}");

        if (!$id) {
            return $this->handleNoDownload('Invalid or expired download token');
        }

        // Retrieve the download object
        $download = PostVideo::find($id);

        if (!$download) {
            return $this->handleNoDownload('Download not found');
        }

        // Retrieve the associated listing
        $listing = Post::find($download->postable_id);

        if (!$listing) {
            return $this->handleNoDownload('Associated listing not found');
        }

        // Extract the file code from the download link
        $fileCode = $this->extractFileCode($download->link);

        if (!$fileCode) {
            return $this->handleNoDownload('Invalid download link format');
        }


        // Get the API key from the environment
        $apiKey = env('DATANODES_API_KEY');

        if (!$apiKey) {
            return $this->handleNoDownload('API key not configured');
        }

        // Get the user's IP address
        $userIp = $this->getUserIp();

        // Cache key for the direct link
        $cacheKey = "direct_link:{$fileCode}:{$userIp}";
        $directLink = Cache::get($cacheKey);

        $secretKey = "2024_DL_GuessWhat_" . $fileCode;
        $md5 = md5($secretKey);

        if (!$directLink) {
            // Make the API request to get the direct download link
            $headers = $this->getHeaders();
            $apiUrl = "http://datanodes.to";

            $response = Http::withHeaders([
                'user-agent' => $headers['user-agent'],
                'x-forwarded-for' => $headers['x-forwarded-for'],
                'x-real-ip' => request()->ip(),
                'x-forwarded-proto' => $headers['x-forwarded-proto']
            ])->get($apiUrl, [
                'op' => 'game_download',
                'key' => $apiKey,
                'file_code' => $fileCode,
                'download' => $md5
            ]);

            if ($response->successful()) {
                $json = $response->json();

                if (isset($json['link'])) {
                    $directLink = $json['link'];
                    // Cache the direct link for 1 hour
                    Cache::put($cacheKey, $directLink, now()->addHour());
                } else {
                    return $this->handleNoDownload('Failed to obtain direct download link');
                }
            } else {
                return $this->handleNoDownload('API request failed: ' . $response->body());
            }
        }

        // Update the download object with the new direct link
        $download->link = $directLink;

        // Log the download initiation (optional but recommended)
        Log::info('Download initiated', [
            'download_id' => $download->id,
            'ip' => $userIp,
            'timestamp' => now(),
        ]);

        $config = [
            'title' => config('settings.download_title'),
            'description' => config('settings.download_description'),
        ];

        // Remove the token from the cache to prevent reuse
        Cache::forget("download_token:{$token}");

        // Return the download view, passing the download object with the updated link
        return view('watch.download', compact('download', 'listing', 'config'));
    }

    private function extractFileCode($url)
    {
        // Parse the URL to get the path
        $path = parse_url($url, PHP_URL_PATH);

        if (!$path) {
            return null;
        }

        // Remove leading slashes
        $path = ltrim($path, '/');

        // Split the path by '/'
        $segments = explode('/', $path);

        if (count($segments) < 1) {
            return null;
        }

        // The file code is the first segment
        return $segments[0];
    }

    private function handleNoDownload($reason)
    {
        $config = [
            'title' => config('settings.nodownload_title'),
            'description' => config('settings.nodownload_description'),
        ];

        return view('watch.download-not-found', compact('config', 'reason'));
    }

    private function getUserIp()
    {
        // If your application is behind a proxy/load balancer (like Cloudflare), you might need to use:
        return request()->header('CF-Connecting-IP') ?? request()->ip();
    }

    private function getHeaders() {
        return array_merge(request()->headers->all(), [
            'user-agent' => ['AnkerGames/1.0'],
        ]);
    }
}
