@extends('layouts.app')
@section('content')

@section('meta')
    <meta name="description" content="Ops sailor, we could not find your content">
@endsection
@section('content')
    <div class="relative overflow-hidden text-white">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24 before:absolute before:-top-14 before:start-1/2 before:bg-[url('../img/hero.svg')] before:opacity-40 before:bg-no-repeat before:bg-top before:w-full before:h-full before:-z-[1] before:transform before:-translate-x-1/2 relative">
            <div class="text-center">
                <h1 class="text-2xl font-bold mb-4">Ahoy sailor! download not found</h1>
                <p class="mt-3 text-gray-600 dark:text-gray-400">
                    @if (request()->has('id'))
                        Sorry, the requested download could not be found.
                    @else
                        Please go back to the game and click on the download button.
                    @endif
                </p>
                </br>
                <a href="/home" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Return to Home
                </a>
            </div>
        </div>
    </div>
@endsection
