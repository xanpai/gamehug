<div class="mb-5">
    <x-form.label for="title" :value="__('Title')" />
    <x-form.input id="title" class="block mt-1 w-full" type="text" name="title"
        value="{{ old('title', isset($listing) ? $listing->title : '') }}" size="lg" required
        placeholder="{{ __('Title') }}" x-model="importerData.title" />
    <x-form.error :messages="$errors->get('title')" class="mt-2" />
    <div class="flex items-center text-xs mt-2">
        <span class="font-medium text-gray-500 mr-2">Permalink</span>
        <span class="text-gray-500">{{ url('/') . '/' }}</span>
        <input type="text" name="slug"
            class="font-medium border-0 py-0 text-xs px-1 inline-flex text-primary-500 bg-transparent focus:ring-0 w-auto placeholder-gray-300 dark:placeholder-gray-500"
            placeholder="slug" value="{{ old('slug', isset($listing) ? $listing->slug : '') }}">
    </div>
</div>
<div class="mb-5">
    <x-form.label for="title_sub" :value="__('Alternative title')" />
    <x-form.input id="title_sub" class="block mt-1 w-full" type="text" name="title_sub"
        value="{{ old('title_sub', isset($listing) ? $listing->title_sub : '') }}"
        placeholder="{{ __('Alternative title') }}" x-model="importerData.title_sub" />
    <div class="text-xs text-gray-400 dark:text-gray-600 mt-2">
        {{ __('Alternative title is used for the translation of the content into your language.') }}</div>
    <x-form.error :messages="$errors->get('title_sub')" class="mt-2" />
</div>
<div class="mb-5">
    <x-form.label for="category" :value="__('Genre')" />
    <div class="relative flex w-full">
        <select name="genre[]" placeholder="Choose" class="selectpicker" multiple id="genre" x-ref="categorySelect"
            required>
            <option value="">Choose</option>
            @foreach ($genres as $genre)
                <option data-text="{{ $genre->title }}" value="{{ $genre->id }}"
                    @if (isset($listing->id) and $listing->genres()->find($genre->id)) selected @endif>{{ $genre->title }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mb-5">
    <x-form.label for="tagline" :value="__('Tag line')" />
    <x-form.input id="tagline" class="block mt-1 w-full" type="text" name="tagline"
        value="{{ old('tagline', isset($listing) ? $listing->tagline : '') }}" placeholder="{{ __('Tag line') }}"
        x-model="importerData.tagline" />
    <x-form.error :messages="$errors->get('tagline')" class="mt-2" />
</div>
<div class="mb-5">
    <x-form.label for="overview" :value="__('Overview')" />
    <x-form.textarea name="overview" placeholder="{{ __('Overview') }}" rows="3"
        x-model="importerData.overview">{{ old('overview', isset($listing) ? $listing->overview : '') }}</x-form.textarea>
    <x-form.error :messages="$errors->get('overview')" class="mt-2" />
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-x-8">
    <div class="mb-5 col-span-4">
        <x-form.label for="scene_id" :value="__('Scene Group')" />
        <x-form.select name="scene_id" id="scene_id" x-model="importerData.scene_id">
            <option>{{ __('Choose') }}</option>
            @foreach ($scenes as $scene)
                <option data-text="{{ $scene->code }}" value="{{ $scene->id }}"
                    @if (isset($listing->scene_id) and $listing->scene_id == $scene->id) selected @endif>{{ $scene->name }}</option>
            @endforeach
        </x-form.select>
        <x-form.error :messages="$errors->get('scene_id')" class="mt-2" />
    </div>
    <div class="mb-5 col-span-4">
        <x-form.label for="release_date" :value="__('Release date')" />
        <x-form.input id="release_date" class="block mt-1 w-full" type="date" name="release_date"
            value="{{ old('release_date', isset($listing->release_date) ? $listing->release_date->format('Y-m-d') : '') }}"
            placeholder="{{ __('Release date') }}" x-model="importerData.release_date" />
        <x-form.error :messages="$errors->get('release_date')" class="mt-2" />
    </div>
    <div class="mb-5 col-span-4">
        <x-form.label for="vote_average" :value="__('Vote average')" />
        <x-form.input id="vote_average" class="block mt-1 w-full" type="text" name="vote_average"
            value="{{ old('vote_average', isset($listing) ? $listing->vote_average : '') }}"
            placeholder="{{ __('Vote average') }}" x-model="importerData.vote_average" />
        <x-form.error :messages="$errors->get('vote_average')" class="mt-2" />
    </div>
    <div class="mb-5 col-span-4">
        <x-form.label for="runtime" :value="__('Runtime')" />
        <x-form.input id="runtime" class="block mt-1 w-full" type="text" name="runtime"
            value="{{ old('runtime', isset($listing) ? $listing->runtime : '') }}" placeholder="{{ __('Runtime') }}"
            x-model="importerData.runtime" />
        <x-form.error :messages="$errors->get('runtime')" class="mt-2" />
    </div>
    <div class="mb-5 col-span-4">
        <x-form.label for="platform" :value="__('Game Platform')" />
        <x-form.select name="platform" id="platform">
            <option value="">{{ __('Choose') }}</option>
            @foreach (config('attr.platform') as $platform)
                <option value="{{ $platform }}" @if (isset($listing->platform) and $listing->platform == $platform) selected @endif>
                    {{ $platform }}</option>
            @endforeach
        </x-form.select>
        <x-form.error :messages="$errors->get('platform')" class="mt-2" />
    </div>
    <div class="mb-5 col-span-4">
        <x-form.label for="view" :value="__('View')" />
        <x-form.input id="view" class="block mt-1 w-full" type="number" name="view"
            value="{{ old('view', isset($listing) ? $listing->view : '') }}" placeholder="{{ __('View') }}" />
        <x-form.error :messages="$errors->get('view')" class="mt-2" />
    </div>
</div>
<div class="mb-5 col-span-4">
    <x-form.label for="developer_name" :value="__('Developer/Publisher Name')" />
    <x-form.input id="developer_name" class="block mt-1 w-full" type="text" name="developer_name"
        value="{{ old('developer_name', isset($listing) ? $listing->developer_name : '') }}"
        placeholder="{{ __('Developer/Publisher Name') }}" />
    <x-form.error :messages="$errors->get('developer_name')" class="mt-2" />
</div>
<div class="mb-5 col-span-4">
    <x-form.label for="developer_link" :value="__('Developer/Publisher Link')" />
    <x-form.input id="developer_link" class="block mt-1 w-full" type="url" name="developer_link"
        value="{{ old('developer_link', isset($listing) ? $listing->developer_link : '') }}"
        placeholder="{{ __('https://example.com') }}" />
    <x-form.error :messages="$errors->get('developer_link')" class="mt-2" />
</div>
<div class="mb-5">
    <x-form.label for="trailer" :value="__('Trailer')" />
    <x-form.input id="trailer" class="block mt-1 w-full" type="text" name="trailer"
        value="{{ old('trailer', isset($listing) ? $listing->trailer : '') }}" placeholder="{{ __('http://') }}"
        x-model="importerData.trailer" />
    <div class="text-xs text-gray-400 dark:text-gray-600 mt-2">exm: https://youtube.com/embed/0000</div>
    <x-form.error :messages="$errors->get('trailer')" class="mt-2" />
</div>

<div class="mb-5">
    <x-form.label for="tag" :value="__('Tags')" />
    <x-form.tag>
        @if (isset($listing->tags))
            @foreach ($listing->tags as $tag)
                @if ($loop->last)
                    {{ '"' . $tag->tag . '"' }}
                @else
                    {{ '"' . $tag->tag . '",' }}
                @endif
            @endforeach
        @endif
    </x-form.tag>
</div>
