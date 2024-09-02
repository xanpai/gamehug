<div class="pb-6 lg:pb-16">
    <div class="swiper swiper-hero">
        <div class="swiper-wrapper">
            @foreach($listings['slider'] as $slide)
            <a href="{{route($slide->type,$slide->slug)}}" class="swiper-slide bg-gray-950">
                <div
                    class="lg:aspect-slide aspect-square relative before:absolute before:inset-0 before:bg-gradient-to-b before:from-gray-950 before:to-transparent before:z-10 after:absolute after:inset-0 after:bg-gradient-to-t after:from-gray-950 after:to-transparent after:via-gray-950/60 after:z-10 rounded-lg">
                    <div
                        class="absolute inset-0 before:absolute before:right-0 rtl:before:left-0 before:top-0 before:bottom-0 before:w-1/5 before:bg-gradient-to-l before:from-gray-950 before:to-transparent after:absolute after:left-0 after:top-0 after:bottom-0 after:w-1/2 after:bg-gradient-to-r after:from-gray-950 after:to-transparent z-10"></div>

                    <img src="{{$slide->slideurl}}"
                        class="absolute h-full w-full object-cover">
                    <div class="absolute left-0 rtl:right-0 rtl:left-auto rtl:text-right lg:top-0 bottom-0 flex flex-col justify-center items-center text-center lg:text-left lg:items-start lg:max-w-3xl w-full z-20">

                        <h3 class="text-3xl 2xl:text-6xl font-bold text-white mb-4 texture-text">{{$slide->title}}</h3>

                        <div class="flex items-center text-sm text-gray-800 dark:text-gray-400 gap-6 mb-4">

                            <div class="relative inline-flex items-center justify-center overflow-hidden ">

                                <span class="inline-flex whitespace-nowrap items-center justify-center px-2 py-2 text-sm rounded-base font-[450] border border-transparent text-white bg-green-500">
                                    {{$slide->vote_average}}
                                </span>
                            </div>
                            @if($slide->platform)
                            <span
                                class="bg-gray-500/50 backdrop-blur-lg text-gray-200 text-xxs font-semibold tracking-wide py-0.5 px-1.5 rounded">{{$slide->platform}}</span>
                            @endif
                            @if($slide->runtime)
                            <span>{{$slide->runtime}}</span>
                            @endif
                            @if($slide->scene_id)
                            <div class="font-medium text-gray-800 dark:text-gray-400">
                                {{$slide->scene->name}}
                            </div>
                            @endif
                            @if($slide->release_date)
                            <div class="font-medium text-gray-800 dark:text-gray-400">
                                {{$slide->release_date->translatedFormat('Y')}}
                            </div>
                            @endif
                        </div>
                        <p class="text-base text-white/60 line-clamp-2 leading-loose">{{$slide->overview}}</p>
                        <div class="mt-8 space-x-4 lg:block hidden">
                            <x-form.primary class="!rounded-full px-6 lg:px-10 py-4" size="md">{{__('Download now')}}
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