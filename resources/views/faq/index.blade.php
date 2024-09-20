@extends('layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-8 min-h-screen flex flex-col">
        <div class="my-6 flex-grow">
            <h1 class="text-lg font-medium text-gray-700 dark:text-white mb-4">{{ __('Frequently Asked Questions') }}</h1>
            <span
                class="text-lg tracking-tighter font-medium text-center mb-5 text-gray-400 line-clamp-1 hidden lg:block">Greetings
                FitGirl - Razor12911-
                Dodi - KaOs</span>
            <div class="bg-gray-900 rounded-lg px-6 py-3 divide-y divide-gray-800/30">
                @forelse ($faqs as $index => $faq)
                    <div x-data="{ open: false }" class="py-3">
                        <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                            <span
                                class="text-gray-200 text-sm font-medium dark:text-gray-300 hover:text-gray-100 transition">
                                {{ $faq['question'] }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 text-green-500 transform transition-transform duration-200"
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
                            <p class="text-gray-400 text-sm">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-400 text-sm py-3">{{ __('No FAQs found.') }}</div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
