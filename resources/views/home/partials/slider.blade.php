<div class="pb-6 lg:pb-16">
    <div class="swiper swiper-hero relative">
        <div class="swiper-wrapper ">
            @foreach ($listings['slider'] as $slide)
                <a href="{{ route($slide->type, $slide->slug) }}" class="swiper-slide bg-white dark:bg-gray-950">
                    <div
                        class="lg:aspect-slide aspect-square relative before:absolute before:inset-0 before:bg-gradient-to-b before:from-blue-50 dark:before:from-gray-950 before:to-transparent before:z-10 after:absolute after:inset-0 after:bg-gradient-to-t after:from-blue-50 dark:after:from-gray-950 after:to-transparent after:via-blue/30 dark:after:via-gray-950/30 after:z-10 rounded-lg">
                        <div
                            class="absolute inset-0 before:absolute before:right-0 rtl:before:left-0 before:top-0 before:bottom-0 before:w-1/5 before:bg-gradient-to-l before:from-blue-50 dark:before:from-gray-950 before:to-transparent after:absolute after:left-0 after:top-0 after:bottom-0 after:w-1/2 after:bg-gradient-to-r after:from-blue-50 dark:after:from-gray-950 after:to-transparent z-10">
                        </div>

                        {{-- Update the picture element to conditionally apply classes --}}
                        {!! picture(
                            $slide->slideurl,
                            null,
                            'absolute h-full w-full object-cover dark:filter dark:brightness-75',
                            $slide->title,
                            'post',
                            true,
                        ) !!}

                        <div
                            class="absolute left-0 rtl:right-0 rtl:left-auto rtl:text-right lg:top-0 bottom-0 flex flex-col justify-center items-center text-center lg:text-left lg:items-start lg:max-w-3xl w-full z-20">

                            <!-- Updated text color to black for light mode -->
                            <h3
                                class="text-3xl 2xl:text-6xl font-bold font-moontank text-gray-900 dark:text-white mb-4 texture-text">
                                {{ $slide->title }}
                            </h3>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 gap-6 mb-4">
                                <div class="relative inline-flex items-center justify-center overflow-hidden ">
                                    <span
                                        class="inline-flex whitespace-nowrap items-center justify-center px-2 py-2 text-sm rounded-base font-[450] border border-transparent text-white bg-green-500">
                                        {{ $slide->vote_average }}
                                    </span>
                                </div>
                                @if ($slide->platform)
                                    <span
                                        class="bg-gray-900/50 dark:bg-gray-500/50 backdrop-blur-lg text-white dark:text-gray-200 text-xxs font-semibold tracking-wide py-0.5 px-1.5 rounded">{{ $slide->platform }}</span>
                                @endif
                                @if ($slide->runtime)
                                    <span>{{ $slide->runtime }}</span>
                                @endif
                                @if ($slide->scene_id)
                                    <div class="font-medium text-gray-600 dark:text-gray-400">
                                        {{ $slide->scene->name }}
                                    </div>
                                @endif
                                @if ($slide->release_date)
                                    <div class="font-medium text-gray-600 dark:text-gray-400">
                                        {{ $slide->release_date->translatedFormat('Y') }}
                                    </div>
                                @endif
                            </div>
                            <p class="text-base text-gray-800/80 dark:text-white/60 line-clamp-2 leading-loose">
                                {{ $slide->overview }}</p>
                            <div class="mt-8 space-x-4 lg:block hidden">
                                <x-form.primary class="!rounded-full px-6 lg:px-10 py-4"
                                    size="md">{{ __('Download now') }}
                                </x-form.primary>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <!-- Add Arrows -->
        <div class="swiper-arrow rtl:right-auto rtl:left-0 !hidden lg:!flex">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Discord Button -->
        <a href="https://discord.gg/XJFKvrNS" target="_blank" rel="noopener noreferrer nofollow"
            class="hidden lg:flex absolute bottom-4 right-4 z-30 
               items-center gap-2 
               px-3 py-2 
               rounded-md 
               bg-[#7289da] hover:bg-[#6a7fc9] 
               transition-all duration-300 ease-in-out
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#7289da]
               group">
            <svg class="w-5 h-5 text-white transition-transform duration-300 ease-in-out group-hover:scale-110"
                viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M20.3 4.3c-1.6-.7-3.3-1.2-5.1-1.5-.2.4-.5.9-.7 1.3-1.9-.3-3.8-.3-5.7 0-.2-.5-.5-1-.7-1.3-1.8.3-3.5.8-5.1 1.5C.4 8.5-.3 12.6.1 16.7c1.6 1.2 3.2 2.2 4.8 2.9.4-.5.7-1.1 1-1.7-.5-.2-1.1-.5-1.6-.7.1-.1.3-.2.4-.3 3.2 1.5 6.7 1.5 9.9 0 .1.1.3.2.4.3-.5.3-1 .5-1.6.7.3.6.6 1.2 1 1.7 1.6-.7 3.2-1.7 4.8-2.9.4-4.1-.3-8.1-3-11.4zM8 14.5c-.9 0-1.7-.9-1.7-1.9 0-1.1.7-1.9 1.7-1.9.9 0 1.7.9 1.7 1.9 0 1-.8 1.9-1.7 1.9zm8 0c-.9 0-1.7-.9-1.7-1.9 0-1.1.7-1.9 1.7-1.9.9 0 1.7.9 1.7 1.9 0 1-.8 1.9-1.7 1.9z" />
            </svg>
            <span
                class="text-white font-bold text-sm whitespace-nowrap transition-transform duration-300 ease-in-out group-hover:translate-x-0.5">
                Join Discord
            </span>
        </a>
    </div>
</div>


@push('javascript')
    <script>
        var swiper = new Swiper('.swiper-hero', {
            pagination: {
                el: '.swiper-hero .swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-hero .swiper-button-next',
                prevEl: '.swiper-hero .swiper-button-prev'
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            loop: true,
            autoHeight: true,
            effect: 'fade',
            watchSlidesProgress: true
        });
    </script>
@endpush
