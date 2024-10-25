<div class="grid grid-cols-1 lg:grid-cols-12 gap-x-10 gap-y-3">
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="title" :value="__('Site title')" />
            <x-form.input id="title" name="title" type="text" class="mt-1 block w-full"
                value="{{ old('title', config('settings.title')) }}" placeholder="{{ __('Site title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="description" :value="__('Site description')" />
            <x-form.input id="description" name="description" type="text" class="mt-1 block w-full"
                value="{{ old('description', config('settings.description')) }}"
                placeholder="{{ __('Site description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('description')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="browse_title" :value="__('Browse title')" />
            <x-form.input id="browse_title" name="browse_title" type="text" class="mt-1 block w-full"
                value="{{ old('browse_title', config('settings.browse_title')) }}"
                placeholder="{{ __('Browse title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('browse_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="browse_description" :value="__('Browse description')" />
            <x-form.input id="browse_description" name="browse_description" type="text" class="mt-1 block w-full"
                value="{{ old('browse_description', config('settings.browse_description')) }}"
                placeholder="{{ __('Browse description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('browse_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="games_title" :value="__('games title')" />
            <x-form.input id="games_title" name="games_title" type="text" class="mt-1 block w-full"
                value="{{ old('games_title', config('settings.games_title')) }}"
                placeholder="{{ __('games title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('games_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="games_description" :value="__('games description')" />
            <x-form.input id="games_description" name="games_description" type="text" class="mt-1 block w-full"
                value="{{ old('games_description', config('settings.games_description')) }}"
                placeholder="{{ __('games description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('games_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="tvshows_title" :value="__('TV Shows title')" />
            <x-form.input id="tvshows_title" name="tvshows_title" type="text" class="mt-1 block w-full"
                value="{{ old('tvshows_title', config('settings.tvshows_title')) }}"
                placeholder="{{ __('TV Shows title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('tvshows_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="tvshows_description" :value="__('TV Shows description')" />
            <x-form.input id="tvshows_description" name="tvshows_description" type="text" class="mt-1 block w-full"
                value="{{ old('tvshows_description', config('settings.tvshows_description')) }}"
                placeholder="{{ __('TV Shows description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('tvshows_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="genre_title" :value="__('Genre title')" />
            <x-form.input id="genre_title" name="genre_title" type="text" class="mt-1 block w-full"
                value="{{ old('genre_title', config('settings.genre_title')) }}"
                placeholder="{{ __('Genre title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('genre_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[genre]</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="genre_description" :value="__('Genre description')" />
            <x-form.input id="genre_description" name="genre_description" type="text" class="mt-1 block w-full"
                value="{{ old('genre_description', config('settings.genre_description')) }}"
                placeholder="{{ __('Genre description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('genre_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[genre]</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="scene_title" :value="__('Scene title')" />
            <x-form.input id="scene_title" name="scene_title" type="text" class="mt-1 block w-full"
                value="{{ old('scene_title', config('settings.scene_title')) }}"
                placeholder="{{ __('Scene title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('scene_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[sortable]
                    [scene]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="scene_description" :value="__('Scene description')" />
            <x-form.input id="scene_description" name="scene_description" type="text" class="mt-1 block w-full"
                value="{{ old('scene_description', config('settings.scene_description')) }}"
                placeholder="{{ __('Scene description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('scene_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[sortable]
                    [scene]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="game_title" :value="__('game title')" />
            <x-form.input id="game_title" name="game_title" type="text" class="mt-1 block w-full"
                value="{{ old('game_title', config('settings.game_title')) }}"
                placeholder="{{ __('game title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('game_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]
                    [description] [release] [scene] [genre]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="game_description" :value="__('game description')" />
            <x-form.input id="game_description" name="game_description" type="text" class="mt-1 block w-full"
                value="{{ old('game_description', config('settings.game_description')) }}"
                placeholder="{{ __('game description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('game_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]
                    [description] [release] [scene] [genre]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="tvshow_title" :value="__('TV Show title')" />
            <x-form.input id="tvshow_title" name="tvshow_title" type="text" class="mt-1 block w-full"
                value="{{ old('tvshow_title', config('settings.tvshow_title')) }}"
                placeholder="{{ __('TV Show title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('tvshow_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]
                    [description] [release] [scene] [genre]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="tvshow_description" :value="__('TV Show description')" />
            <x-form.input id="tvshow_description" name="tvshow_description" type="text" class="mt-1 block w-full"
                value="{{ old('tvshow_description', config('settings.tvshow_description')) }}"
                placeholder="{{ __('TV Show description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('tvshow_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]
                    [description] [release] [scene] [genre]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="episode_title" :value="__('Episode title')" />
            <x-form.input id="episode_title" name="episode_title" type="text" class="mt-1 block w-full"
                value="{{ old('episode_title', config('settings.episode_title')) }}"
                placeholder="{{ __('Episode title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('episode_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]
                    [description] [release] [scene] [genre]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="episode_description" :value="__('Episode description')" />
            <x-form.input id="episode_description" name="episode_description" type="text"
                class="mt-1 block w-full" value="{{ old('episode_title', config('settings.episode_description')) }}"
                placeholder="{{ __('Episode description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('episode_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]
                    [description] [release] [scene] [genre]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="tag_title" :value="__('Tag title')" />
            <x-form.input id="tag_title" name="tag_title" type="text" class="mt-1 block w-full"
                value="{{ old('category_title', config('settings.tag_title')) }}"
                placeholder="{{ __('Tag title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('tag_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[tag]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="tag_description" :value="__('Tag description')" />
            <x-form.input id="tag_description" name="tag_description" type="text" class="mt-1 block w-full"
                value="{{ old('tag_description', config('settings.tag_description')) }}"
                placeholder="{{ __('Tag description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('tag_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[tag]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="search_title" :value="__('Search title')" />
            <x-form.input id="search_title" name="search_title" type="text" class="mt-1 block w-full"
                value="{{ old('search_title', config('settings.search_title')) }}"
                placeholder="{{ __('Search title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('search_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[search]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="search_description" :value="__('Search description')" />
            <x-form.input id="search_description" name="search_description" type="text" class="mt-1 block w-full"
                value="{{ old('search_description', config('settings.search_description')) }}"
                placeholder="{{ __('Search description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('search_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[search]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="trending_title" :value="__('Trending title')" />
            <x-form.input id="trending_title" name="trending_title" type="text" class="mt-1 block w-full"
                value="{{ old('trending_title', config('settings.trending_title')) }}"
                placeholder="{{ __('Trending title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('trending_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="trending_description" :value="__('Trending description')" />
            <x-form.input id="trending_description" name="trending_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('trending_description', config('settings.trending_description')) }}"
                placeholder="{{ __('Trending description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('trending_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="topimdb_title" :value="__('Top IMDb title')" />
            <x-form.input id="topimdb_title" name="topimdb_title" type="text" class="mt-1 block w-full"
                value="{{ old('topimdb_title', config('settings.topimdb_title')) }}"
                placeholder="{{ __('Top IMDb title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('topimdb_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="topimdb_description" :value="__('Top IMDb description')" />
            <x-form.input id="topimdb_description" name="topimdb_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('topimdb_description', config('settings.topimdb_description')) }}"
                placeholder="{{ __('Top IMDb description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('topimdb_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[sortable]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="broadcasts_title" :value="__('Live broadcasts title')" />
            <x-form.input id="broadcasts_title" name="broadcasts_title" type="text" class="mt-1 block w-full"
                value="{{ old('broadcasts_title', config('settings.broadcasts_title')) }}"
                placeholder="{{ __('Live broadcasts title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('broadcasts_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="broadcasts_description" :value="__('Live broadcasts description')" />
            <x-form.input id="broadcasts_description" name="broadcasts_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('broadcasts_description', config('settings.broadcasts_description')) }}"
                placeholder="{{ __('Live broadcasts description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('broadcasts_description')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="broadcast_title" :value="__('Live broadcast title')" />
            <x-form.input id="broadcast_title" name="broadcast_title" type="text" class="mt-1 block w-full"
                value="{{ old('broadcast_title', config('settings.broadcast_title')) }}"
                placeholder="{{ __('Live broadcast title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('broadcast_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="broadcast_description" :value="__('Live broadcast description')" />
            <x-form.input id="broadcast_description" name="broadcast_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('broadcast_description', config('settings.broadcast_description')) }}"
                placeholder="{{ __('Live broadcast description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('broadcast_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="peoples_title" :value="__('Peoples title')" />
            <x-form.input id="peoples_title" name="peoples_title" type="text" class="mt-1 block w-full"
                value="{{ old('peoples_title', config('settings.peoples_title')) }}"
                placeholder="{{ __('Peoples title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('peoples_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="peoples_description" :value="__('Peoples description')" />
            <x-form.input id="peoples_description" name="peoples_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('peoples_description', config('settings.peoples_description')) }}"
                placeholder="{{ __('Peoples description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('peoples_description')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="people_title" :value="__('People title')" />
            <x-form.input id="people_title" name="people_title" type="text" class="mt-1 block w-full"
                value="{{ old('people_title', config('settings.people_title')) }}"
                placeholder="{{ __('People title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('people_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="people_description" :value="__('People description')" />
            <x-form.input id="people_description" name="people_description" type="text" class="mt-1 block w-full"
                value="{{ old('people_description', config('settings.people_description')) }}"
                placeholder="{{ __('People description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('people_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="collections_title" :value="__('Collections title')" />
            <x-form.input id="collections_title" name="collections_title" type="text" class="mt-1 block w-full"
                value="{{ old('collections_title', config('settings.collections_title')) }}"
                placeholder="{{ __('Collections title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('collections_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="collections_description" :value="__('Collections description')" />
            <x-form.input id="collections_description" name="collections_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('collections_description', config('settings.collections_description')) }}"
                placeholder="{{ __('Collections description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('collections_description')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="collection_title" :value="__('Collection title')" />
            <x-form.input id="collection_title" name="collection_title" type="text" class="mt-1 block w-full"
                value="{{ old('collection_title', config('settings.collection_title')) }}"
                placeholder="{{ __('Collection title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('collection_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="collection_description" :value="__('Collection description')" />
            <x-form.input id="collection_description" name="collection_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('collection_description', config('settings.collection_description')) }}"
                placeholder="{{ __('Collection description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('collection_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="blog_title" :value="__('Blog title')" />
            <x-form.input id="blog_title" name="blog_title" type="text" class="mt-1 block w-full"
                value="{{ old('blog_title', config('settings.blog_title')) }}"
                placeholder="{{ __('Blog title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('blog_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="blog_description" :value="__('Blog description')" />
            <x-form.input id="blog_description" name="blog_description" type="text" class="mt-1 block w-full"
                value="{{ old('blog_description', config('settings.blog_description')) }}"
                placeholder="{{ __('Blog description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('blog_description')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="article_title" :value="__('Article title')" />
            <x-form.input id="article_title" name="article_title" type="text" class="mt-1 block w-full"
                value="{{ old('article_title', config('settings.article_title')) }}"
                placeholder="{{ __('Article title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('article_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="article_description" :value="__('Article description')" />
            <x-form.input id="article_description" name="article_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('article_description', config('settings.article_description')) }}"
                placeholder="{{ __('Article description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('article_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="profile_title" :value="__('Profile title')" />
            <x-form.input id="profile_title" name="profile_title" type="text" class="mt-1 block w-full"
                value="{{ old('profile_title', config('settings.profile_title')) }}"
                placeholder="{{ __('Profile title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('profile_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[username]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="profile_description" :value="__('Profile description')" />
            <x-form.input id="profile_description" name="profile_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('profile_description', config('settings.profile_description')) }}"
                placeholder="{{ __('Profile description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('profile_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[username]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="page_title" :value="__('Page title')" />
            <x-form.input id="page_title" name="page_title" type="text" class="mt-1 block w-full"
                value="{{ old('page_title', config('settings.page_title')) }}"
                placeholder="{{ __('Page title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('page_title')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="page_description" :value="__('Page description')" />
            <x-form.input id="page_description" name="page_description" type="text" class="mt-1 block w-full"
                value="{{ old('page_description', config('settings.page_description')) }}"
                placeholder="{{ __('Page description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('page_description')" />
            <div class="mt-3 text-xs text-gray-400 dark:text-gray-300 flex items-center space-x-1">
                <span>{{ __('Available variable') }}</span><span
                    class="font-semibold text-primary-500">[title]</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="faqs_title" :value="__('FAQs title')" />
            <x-form.input id="faqs_title" name="faqs_title" type="text" class="mt-1 block w-full"
                value="{{ old('faqs_title', config('settings.faqs_title')) }}"
                placeholder="{{ __('FAQs title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('faqs_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="faqs_description" :value="__('FAQs description')" />
            <x-form.input id="faqs_description" name="faqs_description" type="text" class="mt-1 block w-full"
                value="{{ old('faqs_description', config('settings.faqs_description')) }}"
                placeholder="{{ __('FAQs description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('faqs_description')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="recent_title" :value="__('Recent updates title')" />
            <x-form.input id="recent_title" name="recent_title" type="text" class="mt-1 block w-full"
                value="{{ old('recent_title', config('settings.recent_title')) }}"
                placeholder="{{ __('Recent updates title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('recent_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="recent_description" :value="__('Recent updates description')" />
            <x-form.input id="recent_description" name="recent_description" type="text" class="mt-1 block w-full"
                value="{{ old('recent_description', config('settings.recent_description')) }}"
                placeholder="{{ __('Recent updates description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('recent_description')" />
        </div>
    </div>

    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="download_title" :value="__('Download page title')" />
            <x-form.input id="download_title" name="download_title" type="text" class="mt-1 block w-full"
                value="{{ old('download_title', config('settings.download_title')) }}"
                placeholder="{{ __('Download page title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('download_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="download_description" :value="__('Download page description')" />
            <x-form.input id="download_description" name="download_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('download_description', config('settings.download_description')) }}"
                placeholder="{{ __('Download page description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('download_description')" />
        </div>
    </div>

    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="nodownload_title" :value="__('Nodownload title')" />
            <x-form.input id="nodownload_title" name="nodownload_title" type="text" class="mt-1 block w-full"
                value="{{ old('nodownload_title', config('settings.nodownload_title')) }}"
                placeholder="{{ __('Nodownload title') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('nodownload_title')" />
        </div>
    </div>
    <div class="lg:col-span-6">
        <div class="mb-5">
            <x-form.label for="nodownload_description" :value="__('Nodownload description')" />
            <x-form.input id="nodownload_description" name="nodownload_description" type="text"
                class="mt-1 block w-full"
                value="{{ old('nodownload_description', config('settings.nodownload_description')) }}"
                placeholder="{{ __('Nodownload description') }}" />
            <x-form.error class="mt-2" :messages="$errors->get('nodownload_description')" />
        </div>
    </div>
</div>
