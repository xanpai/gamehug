@extends('layouts.app')
@section('content')
    <main class="container mx-auto px-4 py-8 min-h-screen flex flex-col">
        <div class="my-6 flex-grow">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Frequently Asked Questions') }}</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">Find answers to the most common questions about
                AnkerGames.</p>
            <p class="text-center text-gray-700 dark:text-white mb-5">Special thanks to CS.RIN.RU and everyone spreading the
                good work.</p>
            <div
                class="bg-gray-200 dark:bg-gray-900 rounded-lg px-6 py-3 divide-y dark:divide-y divide-gray-800/30 shadow-md">
                @forelse ($faqs as $index => $faq)
                    <div x-data="{ open: false }" class="py-3">
                        <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                            <span
                                class="text-gray-800 dark:text-gray-200 text-md font-medium hover:text-gray-600 dark:hover:text-gray-100 transition">
                                {{ $faq['question'] }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 text-green-600 dark:text-green-500 transform transition-transform duration-200"
                                :class="{ 'rotate-90': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95" class="mt-2">
                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500 dark:text-gray-400 text-sm py-3">{{ __('No FAQs found.') }}</div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
