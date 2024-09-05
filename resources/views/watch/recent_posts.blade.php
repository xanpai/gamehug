@extends('layouts.app')

@section('content')
<main class="container mx-auto px-4 py-8 min-h-screen flex flex-col">
    <div class="my-6 flex-grow">
        <h1 class="text-lg font-medium text-gray-700 dark:text-white mb-4">{{ __('Recently Updated Games') }}</h1>
        <div class="bg-gray-900 rounded-lg px-6 py-3 divide-y divide-gray-800/30">
            @forelse ($recentPosts as $post)
            <div class="flex group flex-wrap gap-x-6 items-center py-3">
                <a href="{{ route($post->type, $post->slug) }}" class="flex-1 flex items-center gap-x-6">
                    <div class="relative w-4 h-4">
                        <!-- Outer pulsing glow effect -->
                        <div class="absolute inset-0 w-full h-full rounded-full bg-green-500 animate-ping"></div>
                        <!-- Inner glowing circle with custom animation -->
                        <div class="relative w-full h-full rounded-full bg-green-500 border-green-400 border-2 border-gray-600 animate-glow"></div>
                    </div>
                    <div class="w-28 text-gray-400 text-sm">{{ $post->updated_at->diffForHumans() }}</div>
                    <div class="text-gray-200 text-sm font-medium dark:text-gray-300 hover:text-gray-900 hover:bg-gray-50/70 hover:border-primary-500 dark:hover:text-gray-100 dark:hover:bg-gray-900 transition rounded-lg">
                        {{ $post->title }}
                    </div>
                </a>
                <div class="flex items-center text-gray-400 text-sm animate-pulse">
                    <!-- Green arrow icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    {{ $post->vote_average }}
                </div>
            </div>
            @empty
            <div class="text-gray-400 text-sm py-3">{{ __('No recent posts found.') }}</div>
            @endforelse
        </div>
    </div>
</main>
@endsection