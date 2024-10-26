<div class="relative group overflow-hidden">
    <a href="{{route($listing->type,$listing->slug)}}"
        class="aspect-poster relative transition overflow-hidden cursor-pointer before:absolute before:-inset-px @if(config('settings.poster_type') == 'v2'){{'before:bg-gradient-to-t  before:to-gray-950/[.7]'}}@else{{'before:bg-gradient-to-b  before:to-gray-950/[.4]'}}@endif before:from-gray-950 before:-m-px before:z-[1] before:opacity-0 group-hover:before:opacity-100 block">
        {!! picture($listing->imageurl,config('attr.poster.size_x').','.config('attr.poster.size_y'),'absolute h-full w-full object-cover rounded-md',$listing->title,'post') !!}
        <div class="absolute right-3 top-3 flex items-center justify-end w-auto min-w-[2.5rem] h-10 text-white z-20 hidden group-hover:flex">
            <span class="text-xs inline-flex whitespace-nowrap items-center justify-center px-1 py-1 text-sm rounded border border-transparent text-white bg-green-500">
                {{$listing->vote_average}}
            </span>
        </div>
        <div
            class="hidden group-hover:flex absolute left-1/2 top-1/2 -translate-x-1/2 z-20 -translate-y-1/2 h-14 w-14 items-center justify-center cursor-pointer rounded-full bg-white/50 text-white transition">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-5 w-5" <!-- Updated class for highlighting -->
                >
                <path
                    fill-rule="evenodd"
                    d="M12 3a1 1 0 01.993.883L13 4v11.293l4.146-4.147a1 1 0 111.408 1.414l-5.5 5.5a1 1 0 01-1.408 0l-5.5-5.5a1 1 0 111.408-1.414L11 15.293V4a1 1 0 011-1zM4 21a1 1 0 01.993-.883L5 20h14a1 1 0 01.993.883L20 21a1 1 0 01-.993 1.117L19 22H5a1 1 0 01-.993-1.117L4 21z"
                    clip-rule="evenodd" />
            </svg>

        </div>
    </a>
    @if(config('settings.poster_type') == 'v2')
    <div
        class="p-4 absolute -bottom-10 group-hover:bottom-0 left-0 right-0 transition-all opacity-0 group-hover:opacity-100 z-10">
        <div class="text-xs text-white/50 gap-x-3 mb-0.5">
            @if($listing->runtime)
            <span>{{$listing->runtime}}</span>
            @endif
            @if($listing->release_date)
            <span>{{$listing->release_date->translatedFormat('Y')}}</span>
            @endif
        </div>
        <h3 class="text-sm tracking-tighter font-medium text-white line-clamp-1">{{$listing->title}}</h3>
        <div class="text-xs text-white/50 gap-x-3 mt-1 flex items-center">
            @foreach($listing->genres->slice(0, 1) as $genre)
            <span>{{$genre->title}}</span>
            @endforeach
        </div>
    </div>
    @else
    <div
        class="pt-4 transition">
        <div class="text-xs text-white/50 gap-x-3 mb-0.5">
            @if($listing->runtime)
            <span>{{$listing->runtime}}</span>
            @endif
            @if($listing->release_date)
            <span>{{$listing->release_date->translatedFormat('Y')}}</span>
            @endif
        </div>
        <h3 class="text-sm tracking-tighter font-medium text-gray-300 line-clamp-1">{{$listing->title}}</h3>
        <div class="text-xs text-white/50 gap-x-3 mt-1 flex items-center">
            @foreach($listing->genres->slice(0, 1) as $genre)
            <span>{{$genre->title}}</span>
            @endforeach
            <span
                class="text-xxs bg-gray-800 rounded py-0.5 px-1.5 text-gray-300 !ml-auto">{{$listing->type == 'game' ? __('Game') : __('TV Show')}}</span>
        </div>
    </div>
    @endif
</div>