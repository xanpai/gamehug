@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-8">
    <div class="my-6">
        <h1 class="text-lg font-medium text-gray-700 dark:text-white mb-4">{{ __('Recently Updated Posts') }}</h1>
        <div class="bg-gray-900 rounded-lg px-6 py-3 divide-y divide-gray-800/30">
            @forelse ($recentPosts as $post)
            <a href="{{ route($post->type, $post->slug) }}" class="flex group flex-wrap gap-x-6 items-center py-3">
                <div class="relative w-4 h-4">
                    <!-- Outer pulsing glow effect -->
                    <div class="absolute inset-0 w-full h-full rounded-full bg-green-500 animate-ping"></div>
                    <!-- Inner glowing circle with custom animation -->
                    <div class="relative w-full h-full rounded-full bg-green-500 border-green-400 border-2 border-gray-600 animate-glow"></div>
                </div>
                <div class="w-28 text-gray-400 text-sm">{{ __('Updated') }}: {{ $post->updated_at->diffForHumans() }}</div>
                <div class="flex-1">
                    <div class="text-gray-200 group-hover:underline text-sm font-medium">{{ $post->title }}</div>
                </div>
                <div class="text-gray-400 text-sm">
                    {{ $post->vote_average }}
                </div>
            </a>
            @empty
            <div class="text-gray-400 text-sm py-3">{{ __('No recent posts found.') }}</div>
            @endforelse
        </div>
    </div>
</main>
@endsection