<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddNoIndexTag
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response->isSuccessful() && !$this->isResponseEmpty($response)) {
            $content = $response->getContent();

            // Check if it's an HTML response
            if (stripos($response->headers->get('Content-Type'), 'text/html') !== false) {
                $noIndexTag = '<meta name="robots" content="noindex">';

                if (stripos($content, '<head>') !== false) {
                    $content = str_ireplace('<head>', "<head>\n    " . $noIndexTag, $content);
                    $response->setContent($content);
                } else {
                    // If there's no <head> tag, prepend the noindex tag to the content
                    $content = $noIndexTag . "\n" . $content;
                    $response->setContent($content);
                }
            }
        }

        return $response;
    }

    private function isResponseEmpty($response)
    {
        $content = $response->getContent();
        return empty($content) || $content === '{}' || $content === '[]';
    }
}
