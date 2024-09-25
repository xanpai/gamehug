@extends('layouts.app')
@section('content')
    <div x-data="{ selectedStream: '0', trailerOpen: false, iframeSrc: '', downloadOpen: false, repackFeaturesOpen: false }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-screen-xl 2xl:max-w-screen-2xl 3xl:max-w-[100rem] 5xl:max-w-[120rem] mx-auto">
                <!--Removed Player By commenting out below line -->
                {{-- <livewire:watch-component :listing="$listing" /> --}}
                <div class="flex lg:hidden gap-x-8">

                    <div class="max-w-[6rem] w-full mx-auto">
                        <div class="aspect-[2/3] relative rounded-md transition overflow-hidden cursor-pointer ">
                            <img src="{{ $listing->imageurl }}" class="absolute  h-full w-full object-cover">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl tracking-tighter font-semibold text-gray-100 line-clamp-1">{{ $listing->title }}
                        </h3>

                        <div class="flex items-center text-gray-400 dark:text-gray-400 text-xs mt-3 space-x-4">
                            @if ($listing->platform)
                                <span
                                    class="bg-gray-500/50 backdrop-blur-lg text-gray-200 text-xxs font-semibold tracking-wide py-0.5 px-1.5 rounded">{{ $listing->platform }}</span>
                            @endif
                            @if ($listing->runtime)
                                <span>{{ $listing->runtime }}</span>
                            @endif
                            @if ($listing->release_date)
                                <span>{{ $listing->release_date->translatedFormat('Y') }}</span>
                            @endif
                            <span
                                class="hidden lg:block">{{ __('Published on, :date', ['date' => $listing->created_at->diffForHumans()]) }}</span>
                        </div>
                        @if ($listing->trailer)
                            <x-form.secondary @click="trailerOpen = true;iframeSrc = '{{ $listing->trailer }}'"
                                class=" mt-3">{{ __('Watch trailer') }}</x-form.secondary>
                        @endif
                    </div>
                </div>
                @if (isset($listing->arguments->information))
                    <div class="bg-red-500 text-white py-4 px-5 my-5 rounded-lg flex items-center gap-x-4">
                        <x-ui.icon name="info" class="w-8 h-8" fill="currentColor" />
                        <div class="flex-1">
                            <p class="text-white text-sm">{{ $listing->arguments->information }}</p>
                        </div>
                    </div>
                @endif
                <div class="lg:flex gap-6 xl:gap-12 relative">
                    <!-- Background image container -->
                    <div class="absolute inset-0 z-0">
                        <div class="relative w-full h-full">
                            <div
                                class="absolute inset-0 before:absolute before:right-0 before:top-0 before:bottom-0 before:w-1/5 before:bg-gradient-to-l before:from-gray-950 before:to-transparent after:absolute after:left-0 after:top-0 after:bottom-0 after:w-1/2 after:bg-gradient-to-r after:from-gray-950 after:to-transparent z-10">
                            </div>
                            <div
                                class="absolute inset-0 before:absolute before:inset-0 before:bg-gradient-to-b before:from-gray-950 before:to-transparent before:z-10 after:absolute after:inset-0 after:bg-gradient-to-t after:from-gray-950 after:to-transparent after:via-gray-950/60 after:z-10">
                            </div>
                            <img src="{{ $listing->coverurl }}" class="absolute h-full w-full object-cover"
                                alt="{{ $listing->title }} cover">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 w-full lg:flex gap-6 xl:gap-12">
                        <!-- Left column (poster image) -->
                        <div class="max-w-[16rem] w-full mx-auto hidden lg:block">
                            <div class="aspect-[2/3] relative rounded-md transition overflow-hidden cursor-pointer">
                                <img src="{{ $listing->imageurl }}" class="absolute h-full w-full object-cover"
                                    alt="{{ $listing->title }} poster">
                            </div>
                            @if ($listing->trailer)
                                <x-form.secondary @click="trailerOpen = true;iframeSrc = '{{ $listing->trailer }}'"
                                    class="w-full mt-4">{{ __('Watch trailer') }}</x-form.secondary>
                            @endif
                        </div>

                        <!-- Right column (details) -->
                        <div class="flex-1 text-white">
                            @if (config('settings.show_titlesub') == 'active')
                                <h2 class="text-lg tracking-tighter font-medium text-gray-400 line-clamp-1 hidden lg:block">
                                    {{ $listing->title_sub }}</h2>
                            @endif
                            <h1 class="text-3xl tracking-tighter font-semibold line-clamp-1 hidden lg:block">
                                {{ $listing->title }}</h1>

                            <div class="hidden lg:flex items-center text-gray-400 text-xs mt-3 space-x-4">
                                @if ($listing->platform)
                                    <span
                                        class="bg-gray-500/50 backdrop-blur-lg text-gray-200 text-xs font-semibold tracking-wide py-0.5 px-1.5 rounded">{{ $listing->platform }}</span>
                                @endif
                                @if ($listing->runtime)
                                    <span>{{ $listing->runtime }}</span>
                                @endif
                                @if ($listing->release_date)
                                    <span>{{ $listing->release_date->translatedFormat('Y') }}</span>
                                @endif
                                <span
                                    class="hidden lg:block">{{ __('Published on, :date', ['date' => $listing->created_at->diffForHumans()]) }}</span>
                            </div>
                            <div class="flex items-center gap-6 my-5">
                                <div class="flex items-center gap-x-4 flex-grow">
                                    <div class="flex-shrink-0">
                                        <div class="relative inline-flex items-center justify-center overflow-visible">
                                            <!-- Inner glowing circle with custom animation -->
                                            <span
                                                class="relative inline-flex whitespace-nowrap items-center justify-center px-1.5 py-1.5 text-sm rounded-base font-[450] border border-transparent text-white bg-green-500 animate-glow">
                                                {{ $listing->vote_average }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex flex-1 items-center gap-x-1">
                                        <livewire:watchlist-component :model="$listing" />
                                        <livewire:report-component :model="$listing" />
                                        <div class="mx-6 hidden lg:block"></div>
                                        <livewire:reaction-component :model="$listing" />
                                    </div>
                                </div>
                            </div>

                            <p class="text-gray-400 mt-3">{{ $listing->overview }}</p>
                            <div class="my-6 space-y-2 text-sm tracking-tighter">
                                @if ($listing->scene_id)
                                    <div class="grid sm:flex gap-x-3">
                                        <div class="min-w-[150px] max-w-[200px] text-gray-500">
                                            {{ __('Release Group') }}
                                        </div>
                                        <div class="font-medium text-gray-800 dark:text-gray-300">
                                            <a href="{{ route('scene', ['scene' => $listing->scene->slug]) }}"
                                                class="hover:underline">{{ $listing->scene->name }}</a>
                                        </div>
                                    </div>
                                @endif
                                @if (count($listing->genres) > 0)
                                    <div class="grid sm:flex gap-x-3">
                                        <div class="min-w-[150px] max-w-[200px] text-gray-500">
                                            {{ __('Genre') }}
                                        </div>
                                        <div class="font-medium text-gray-800 dark:text-gray-300">
                                            @foreach ($listing->genres as $genre)
                                                <a href="{{ route('genre', ['genre' => $genre->slug]) }}"
                                                    class="not-last-child-after inline-block mr-1 after:content-[','] last:mr-0 last:after:hidden hover:underline">{{ $genre->title }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if ($listing->release_date)
                                    <div class="grid sm:flex gap-x-3">
                                        <div class="min-w-[150px] max-w-[200px] text-gray-500">
                                            {{ __('Released') }}
                                        </div>
                                        <div class="font-medium text-gray-800 dark:text-gray-400">
                                            {{ $listing->release_date->translatedFormat('d M, Y') }}
                                        </div>
                                    </div>
                                @endif
                                @if (count($listing->peoples) > 0)
                                    <div class="grid sm:flex gap-x-3">
                                        <div class="min-w-[150px] max-w-[200px] text-gray-500">
                                            {{ __('Cast') }}
                                        </div>
                                        <div class="font-medium text-gray-800 dark:text-gray-300">
                                            @foreach ($listing->peoples as $people)
                                                <a href="{{ route('people', ['slug' => $people->slug]) }}"
                                                    class="not-last-child-after inline-block mr-1 after:content-[','] last:mr-0 last:after:hidden hover:underline">{{ $people->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($listing->developer_name)
                                    <div class="grid sm:flex gap-x-3 mt-2">
                                        <div class="min-w-[300px] max-w-[600px] text-gray-500">
                                            <div class="font-medium text-gray-800 dark:text-gray-300">
                                                <span>Please support the developers - publishers by purchasing the game at
                                                    @if ($listing->developer_link)
                                                        <a href="{{ $listing->developer_link }}" target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="hover:underline text-white">{{ $listing->developer_name }}</a>
                                                    @else
                                                        {{ $listing->developer_name }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center justify-start gap-4 my-5">
                                @if (count($listing->downloads) > 0)
                                    <x-form.primary class="px-8 gap-4" @click="downloadOpen = true">
                                        <span>{{ __('Download') }}</span>
                                        <svg class="w-5 h-5 animate-bounce fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path
                                                d="M16.59 9H15V4c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v5H7.41c-.89 0-1.34 1.08-.71 1.71l4.59 4.59c.39.39 1.02.39 1.41 0l4.59-4.59c.63-.63.19-1.71-.7-1.71zM5 19c0 .55.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1H6c-.55 0-1 .45-1 1z">
                                            </path>
                                        </svg>
                                    </x-form.primary>
                                @endif
                                @if ($listing->repack_features)
                                    <x-form.secondary class="px-8 gap-4 ml-auto" @click.prevent="repackFeaturesOpen = true">
                                        <span>{{ __('Game Features') }}</span>
                                    </x-form.secondary>
                                @endif
                            </div>
                        </div>
                    </div>
                    @include('partials.ads', ['id' => 1])
                </div>
                @if ($listing->body)
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold text-white mb-3">{{ $listing->title }}
                            {{ __('Free Download - Game Review') }} </h2>
                        <div class="text-gray-300 prose prose-invert max-w-none">
                            @parseTabs($listing->body)
                        </div>
                    </div>
                @endif
                <div class="flex flex-wrap gap-2 mt-5 mb-6">
                    @include('watch.partials.tag')
                </div>

                <div class="pb-6">
                    <livewire:comments :model="$listing" />
                </div>
                <div class="custom-container">
                    <div class="py-6 lg:py-14">
                        <div class="flex flex-col lg:flex-row lg:items-center mb-6">
                            <h3
                                class="text-lg xl:text-xl dark:text-white font-semibold lg:text-left rtl:text-right capitalize flex-1">
                                {{ __('Recommended For You') }}</h3>
                        </div>
                        <div class="grid grid-cols-2 xl:grid-cols-6 2xl:grid-cols-8 gap-6">
                            @foreach ($recommends as $recommend)
                                <x-ui.post :listing="$recommend" />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="fixed inset-0 bg-gray-800/40 backdrop-blur-md z-50 transition-opacity" x-show="trailerOpen"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true"
                    style="display: none;"></div>
                <!-- Modal dialog -->
                <div id="search-modal"
                    class="fixed inset-0 z-50 overflow-hidden flex items-start top-20 justify-center px-4 sm:px-6"
                    role="dialog" aria-modal="true" x-show="trailerOpen"
                    x-transition:enter="transition ease-in-out duration-200"
                    x-transition:enter-start="opacity-0 trangray-y-4" x-transition:enter-end="opacity-100 trangray-y-0"
                    x-transition:leave="transition ease-in-out duration-200"
                    x-transition:leave-start="opacity-100 trangray-y-0" x-transition:leave-end="opacity-0 trangray-y-4"
                    style="display: none;">
                    <div class="bg-white dark:bg-gray-900 overflow-auto max-w-6xl w-full rounded-xl"
                        @click.outside="trailerOpen = false" @keydown.escape.window="trailerOpen = false">


                        <iframe :src="iframeSrc" title="Trailer embed" frameborder="0" class="w-full aspect-video"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>

                    </div>
                </div>
                <div class="fixed inset-0 bg-gray-800/40 backdrop-blur-md z-50 transition-opacity" x-show="downloadOpen"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true"
                    style="display: none;"></div>
                <!-- Modal dialog -->
                <div id="download-modal"
                    class="fixed inset-0 z-50 overflow-hidden flex items-center top-20 justify-center px-4 sm:px-6"
                    role="dialog" aria-modal="true" x-show="downloadOpen"
                    x-transition:enter="transition ease-in-out duration-200"
                    x-transition:enter-start="opacity-0 trangray-y-4" x-transition:enter-end="opacity-100 trangray-y-0"
                    x-transition:leave="transition ease-in-out duration-200"
                    x-transition:leave-start="opacity-100 trangray-y-0" x-transition:leave-end="opacity-0 trangray-y-4"
                    style="display: none;">
                    <div class="bg-white dark:bg-gray-900 max-w-xl w-full rounded-xl p-6 lg:p-10"
                        @click.outside="downloadOpen = false" @keydown.escape.window="downloadOpen = false">

                        <h3 class="text-lg xl:text-xl dark:text-white font-semibold mb-3 text-center capitalize flex-1">
                            {{ __('Download Link') }}</h3>
                        <ul
                            class="flex flex-col divide-y divide-gray-200 dark:divide-gray-800 max-h-[60vh] overflow-auto scrollbar-thumb-gray-700 scrollbar-track-transparent -mr-4 pr-4 scrollbar-rounded-lg scrollbar-thin">
                            @foreach ($listing->downloads as $download)
                                <li
                                    class="inline-flex items-center justify-between gap-x-2 py-4 font-medium text-gray-800 dark:text-white">
                                    <div>{{ $download->label }}</div>
                                    <x-form.primary href="{{ route('download.initiate', ['id' => $download->id]) }}"
                                        class="px-5 gap-2 !py-2.5 !rounded-full">
                                        <span class="font-normal">{{ __('Download') }}</span>
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path
                                                d="M16.59 9H15V4c0-.55-.45-1-1-1h-4c-.55 0-1 .45-1 1v5H7.41c-.89 0-1.34 1.08-.71 1.71l4.59 4.59c.39.39 1.02.39 1.41 0l4.59-4.59c.63-.63.19-1.71-.7-1.71zM5 19c0 .55.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1H6c-.55 0-1 .45-1 1z">
                                            </path>
                                        </svg>
                                    </x-form.primary>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @if ($listing->repack_features)
                    <!-- Repack Features Modal -->
                    <div class="fixed inset-0 z-[60] overflow-hidden" x-show="repackFeaturesOpen"
                        x-transition:enter="transition ease-out" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gray-800/40 backdrop-blur-md" @click="repackFeaturesOpen = false">
                        </div>

                        <!-- Modal content -->
                        <div class="flex items-center justify-center min-h-screen p-4">
                            <div class="relative bg-white dark:bg-gray-900 max-w-xl w-full rounded-xl shadow-lg p-6 lg:p-10 overflow-hidden"
                                x-show="repackFeaturesOpen" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                @click.away="repackFeaturesOpen = false"
                                @keydown.escape.window="repackFeaturesOpen = false">

                                <h3
                                    class="text-lg xl:text-xl text-gray-900 dark:text-white font-semibold mb-3 text-center">
                                    {{ __('Repack Features') }}
                                </h3>
                                <div
                                    class="prose dark:prose-invert max-w-none max-h-[60vh] overflow-auto scrollbar-thumb-gray-700 scrollbar-track-transparent pr-4 scrollbar-rounded-lg scrollbar-thin">
                                    {!! $listing->repack_features !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @push('javascript')
        <script>
            function shareClick(event) {
                var $this = event.target,
                    dataType = $this.getAttribute('data-type'),
                    dataTitle = $this.getAttribute('data-title'),
                    dataMedia = $this.getAttribute('data-media'),
                    dataSef = $this.getAttribute('data-sef');

                switch (dataType) {
                    case 'facebook':
                        shareWindow('https://www.facebook.com/sharer/sharer.php?u=' + dataSef);
                        break;

                    case 'twitter':
                        shareWindow('https://twitter.com/intent/tweet?text=' + encodeURIComponent(dataTitle) + ' ' +
                            encodeURIComponent(dataSef));
                        break;

                    case 'pinterest':
                        shareWindow('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(dataSef) + '&media=' +
                            dataMedia + '&description=' + encodeURIComponent(dataTitle));
                        break;

                    case 'whatsapp':
                        shareWindow('whatsapp://send?text=' + encodeURIComponent(dataTitle) + ' ' + encodeURIComponent(
                            dataSef));
                        break;

                    case 'telegram':
                        shareWindow('https://t.me/share/url?url=' + encodeURIComponent(dataSef) + ' ' + '&text=' +
                            encodeURIComponent(dataTitle) + ' 🎮 ');
                        break;
                }

                function shareWindow(url) {
                    window.open(url, "_blank");
                }
            }
        </script>
    @endpush
@endsection
