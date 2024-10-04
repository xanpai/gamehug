<div class="relative overflow-hidden">
    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24 before:absolute before:-top-14 before:start-1/2 before:bg-[url('../img/hero.svg')] before:opacity-40 before:bg-no-repeat before:bg-top before:w-full before:h-full before:-z-[1] before:transform before:-translate-x-1/2 relative">
        <div class="text-center">
            <h1 class="text-4xl font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Game Request') }}
            </h1>
            <p class="mt-3 text-gray-600 dark:text-gray-400">
                {{ __('Request the Games that you would like to see, and we\'ll add them quickly') }}
            <p class="animate-pulse mt-5 text-gray-900 dark:text-white">Note: All request status will be shared in our
                Discord server,
                please join our Discord to view your request status.</p </p>
            <div class="mt-7 sm:mt-12 mx-auto max-w-4xl relative">
                <form method="post" action="{{ route('game.request.store') }}" class="flex text-gray-400 relative"
                    @keydown.window.ctrl.q="$refs.searchInput.focus();">
                    @csrf
                    <div class="absolute left-6 top-1/2 -translate-y-1/2">
                        <x-ui.icon name="search" stroke-width="2" class="w-5 h-5" />
                    </div>
                    <input type="text" name="title"
                        class="placeholder-gray-400/60 text-gray-700 h-14 lg:h-16 px-16 flex-1 w-full text-sm bg-white dark:bg-gray-900 dark:border-gray-800 shadow-gray-100 shadow-sm dark:text-white dark:shadow-none border border-gray-300/80 rounded-full focus:border-primary-500 focus:ring-primary-500 focus:bg-white focus:dark:border-primary-500"
                        placeholder="{{ __('Enter game title') }}" x-ref="searchInput" required>
                    <button type="submit"
                        class="absolute right-6 top-1/2 -translate-y-1/2 bg-primary-500 text-white px-4 py-2 rounded-full">
                        {{ __('Request') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@if (!empty($listings))
    <div class="grid grid-cols-2 xl:grid-cols-5 2xl:grid-cols-8 gap-8">
        @foreach ($listings as $listing)
            <x-ui.request-post :listing="$listing" />
        @endforeach
    </div>
@endif
