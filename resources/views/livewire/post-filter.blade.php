<div class="pb-6 lg:pb-16" x-data="{ filterOpen: @entangle('filterOpen'), loading: @entangle('loading') }">
    <div class="custom-container">

        @if (config('settings.listing_filter') == 'v2')
            @include('browse.partials.filterv2')
        @else
            @include('browse.partials.filterv1')
        @endif
        @if (config('settings.listing_genre') == 'active')
            @include('browse.partials.genre')
        @endif
        <div class="grid grid-cols-2 xl:grid-cols-6 2xl:grid-cols-8 gap-6">
            @for ($i = 1; $i <= 8; $i++)
                <div class="relative group animate-pulse" wire:loading wire:target="filter">
                    <div class="aspect-[2/3] relative bg-gray-900 rounded-lg">
                    </div>
                    <div class="pt-4 transition">
                        <div class="text-xs text-white/50 space-x-3 mb-2 flex items-center">
                            <span class="h-3 w-20 rounded-lg bg-gray-900 block"></span>
                            <span class="h-3 w-14 rounded-lg bg-gray-900 block"></span>
                        </div>
                        <h3 class="text-sm tracking-tighter font-medium text-gray-300 line-clamp-1">
                            <div class="w-10/12 h-4 rounded-lg bg-gray-900"></div>
                        </h3>
                    </div>
                </div>
            @endfor
        </div>
        <div class="grid grid-cols-2 xl:grid-cols-6 2xl:grid-cols-8 gap-6" wire:loading.remove.class="hidden"
            wire:target="filter">

            @foreach ($listings as $listing)
                <x-ui.post :listing="$listing" :title="$listing->title" :image="$listing->imageurl" :vote="$listing->vote_average" :genres="$listing->genres" />

                @if ($loop->index == 7)
                    <div class="col-span-full">
                        @include('partials.ads', ['id' => 3])
                    </div>
                @endif
                @if ($loop->index == 7 and (empty($page) or $page == 1) and config('settings.top_week') == 'active')
                    <div class="col-span-full">
                        <div class="xl:py-5">
                            <div class="rounded-xl h-full p-6 xl:p-8 bg-white dark:bg-gray-900">
                                <h3
                                    class="text-xl font-semibold text-gray-900 dark:text-gray-300 mb-5 flex items-center space-x-3">
                                    <span class="text-2xl">🔥</span>
                                    <span>{{ __('Top this week') }}</span>
                                </h3>
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    @foreach ($recommends as $recommend)
                                        <div class="flex space-x-8 items-center relative">
                                            <a href="{{ route($recommend->type, $recommend->slug) }}"
                                                class="flex-1 group flex gap-x-6">

                                                <div
                                                    class="aspect-[2/3] w-16 relative bg-gray-900 rounded-md transition overflow-hidden cursor-pointer group-hover:opacity-60">
                                                    <img src="{{ $recommend->imageurl }}"
                                                        class="absolute h-full w-full object-cover">

                                                </div>
                                                <div class="flex-1">

                                                    <div
                                                        class="text-xs text-gray-900 dark:text-white/50 space-x-3 mb-0.5">
                                                        @if ($recommend->runtime)
                                                            <span>{{ __(':time min', ['time' => $recommend->runtime]) }}</span>
                                                        @endif
                                                        @if ($recommend->release_date)
                                                            <span>{{ $recommend->release_date->translatedFormat('Y') }}</span>
                                                        @endif
                                                    </div>
                                                    <h3
                                                        class="text-sm tracking-tighter group-hover:underline font-medium text-gray-900 dark:text-gray-300 line-clamp-1">
                                                        {{ $recommend->title }}</h3>
                                                    <div
                                                        class="text-xs text-gray-900 dark:text-white/50 space-x-3 mt-2 flex items-center">
                                                        @foreach ($recommend->genres->slice(0, 1) as $genre)
                                                            <span>{{ $genre->title }}</span>
                                                        @endforeach
                                                        @if ($recommend->type == 'game')
                                                            <span
                                                                class="text-xxs bg-gray-800 rounded py-0.5 px-1.5 text-gray-300">
                                                                {{ __('Game') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div
                                                    class="absolute right-3 top-3 flex items-center justify-end w-auto min-w-[2.5rem] h-10 text-white">
                                                    <span
                                                        class="text-xs inline-flex whitespace-nowrap items-center justify-center px-1 py-1 text-sm rounded border border-transparent text-white bg-green-500">
                                                        {{ $listing->vote_average }}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-full hidden 2xl:block">

                    </div>
                @endif
            @endforeach
        </div>
        {{ $listings->links('partials.pagination') }}
    </div>

</div>
