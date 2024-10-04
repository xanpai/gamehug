@extends('layouts.app')

@section('content')
    <main
        class="containerpx-4 py-8 min-h-screen flex flex-col max-w-screen-xl 2xl:max-w-screen-2xl 3xl:max-w-[100rem] 5xl:max-w-[120rem] mx-auto">
        <div class="my-6 flex-grow">
            <h1 class="text-2xl font-medium text-gray-700 dark:text-white mb-4">{{ __('Recently Updated Games') }}</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">This page shows all the repacks and portable games
                updated within the last 7 days, for older entries refer to our discord.</p>
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg px-6 py-3 divide-y divide-gray-500/30 drop-shadow-2xl">
                @forelse ($recentPosts as $date => $posts)
                    <div class="py-4">
                        <h2 class="text-md font-semibold text-gray-900 dark:text-gray-300 mb-2">
                            {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h2>
                        @foreach ($posts as $post)
                            <div class="flex group flex-wrap gap-x-6 items-center py-3">
                                <a href="{{ route($post->type, $post->slug) }}" class="flex-1 flex items-center gap-x-6">
                                    <div class="relative w-4 h-4">
                                        <!-- Outer pulsing glow effect -->
                                        <div class="absolute inset-0 w-full h-full rounded-full bg-green-500 animate-ping">
                                        </div>
                                        <!-- Inner glowing circle with custom animation -->
                                        <div
                                            class="relative w-full h-full rounded-full bg-green-500 border-green-400 border-2 border-gray-600 animate-glow">
                                        </div>
                                    </div>
                                    <div class="w-28 text-gray-900 dark:text-gray-400 text-sm">
                                        {{ $post->updated_at->format('H:i') }}</div>
                                    <div
                                        class="text-gray-200 text-sm font-medium text-gray-900 dark:text-gray-300 hover:text-gray-900 hover:text-primary-500 hover:border-primary-500 dark:hover:text-gray-100 dark:hover:bg-gray-900 transition rounded-lg">
                                        {{ $post->title }}
                                    </div>
                                </a>
                                <div class="flex items-center text-gray-90 dark:text-gray-400 text-sm animate-pulse">
                                    <!-- Green arrow icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500 mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    {{ $post->vote_average }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="text-gray-400 text-sm py-3">{{ __('No recent posts found.') }}</div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
