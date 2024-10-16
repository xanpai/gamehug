<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\PostJob;
use App\Models\Genre;
use App\Models\Scene;
use App\Models\Post;
use App\Models\PostPeople;
use App\Models\PostSubtitle;
use App\Models\Tag;
use App\Models\PostVideo;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Traits\PostTrait;
use App\Traits\PeopleTrait;
use OneSignal;
use Illuminate\Support\Facades\DB;

class gameController extends Controller
{
    use PeopleTrait, PostTrait;

    public function index(Request $request)
    {
        $config = [
            'title' => __('Games'),
            'nav' => 'game',
            'filter' => true,
            'route' => 'game',
            'create' => true,
        ];

        // Filter inputs
        $search = $request->input('q');
        $status = $request->input('status');
        $genre_id = $request->input('genre_id');
        $member = $request->input('member');
        $featured = $request->input('featured');
        $slider = $request->input('slider');
        $searchBy = in_array($request->input('search_by'), ['title']) ? $request->input('search_by') : 'title';
        $sort = in_array($request->sorting, ['asc', 'desc']) ? $request->sorting : 'desc';
        $perPage = config('attr.page_limit');

        // Query
        $listings = Post::where('type', 'game')
            ->when(!Auth::user()->isAdmin(), function ($query) {
                // For moderators, only show their own posts
                $query->where('user_id', Auth::id());
            })
            ->when($search, function ($query) use ($search) {
                return $query->searchUrl($search);
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($member, function ($query) use ($member) {
                return $query->where('member', $member);
            })
            ->when($featured, function ($query) use ($featured) {
                return $query->where('featured', $featured);
            })
            ->when($slider, function ($query) use ($slider) {
                return $query->where('slider', $slider);
            })
            ->when($genre_id, function ($query) use ($genre_id) {
                return $query->whereHas('genres', function ($query) use ($genre_id) {
                    return $query->where('genres.id', $genre_id);
                });
            })
            ->orderBy('id', $sort)
            ->paginate($perPage)
            ->appends($request->all());

        return view('admin.post.index', compact('config', 'listings', 'request'));
    }

    public function create()
    {
        $config = [
            'title' => __('Game'),
            'route' => 'game',
            'nav' => 'game',
        ];

        $tabs = [
            'overview' => __('Overview'),
            'video' => __('Video'),
            'people' => __('People'),
            'subtitle' => __('Subtitle'),
            'advanced' => __('Advanced'),
        ];
        $genres = Genre::get();
        $scenes = Scene::where('subtitle', 'disable')->get();
        return view('admin.post.form', compact('config', 'tabs', 'genres', 'scenes'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'developer_name' => 'nullable|string|max:255',
            'developer_link' => 'nullable|url|max:255',
        ]);

        $model = new Post();

        $folderDate = date('m-Y');

        if ($request->hasFile('image') || $request->filled('image_url')) {
            $imagename = Str::random(10);
            $imageFile = $request->image ?? $request->input('image_url');
            $uploaded_image = fileUpload($imageFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.size_x'), config('attr.poster.size_y'), $imagename);
            fileUpload($imageFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.size_x'), config('attr.poster.size_y'), $imagename, 'webp');
            $model->image = $uploaded_image;
        }

        if ($request->hasFile('cover') || $request->filled('cover_url')) {
            $imagename = Str::random(10);
            $coverFile = $request->image ?? $request->input('cover_url');
            $uploaded_cover = fileUpload($coverFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.cover_size_x'), config('attr.poster.cover_size_y'), 'cover-' . $imagename);
            fileUpload($coverFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.cover_size_x'), config('attr.poster.cover_size_y'), 'cover-' . $imagename, 'webp');
            $model->cover = $uploaded_cover;
        }

        if ($request->hasFile('slide') || $request->filled('slide_url')) {
            $imagename = Str::random(10);
            $slideFile = $request->slide ?? $request->input('slide_url');
            $uploaded_slide = fileUpload($slideFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.slide_x'), config('attr.poster.slide_y'), 'slide-' . $imagename);
            fileUpload($slideFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.slide_x'), config('attr.poster.slide_y'), 'slide-' . $imagename, 'webp');
            $model->slide = $uploaded_slide;
        }
        if ($request->hasFile('story') || $request->filled('story_url')) {
            $imagename = Str::random(10);
            $storyFile = $request->story ?? $request->input('story_url');
            $uploaded_story = fileUpload($storyFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.story_x'), config('attr.poster.story_y'), 'story-' . $imagename);
            fileUpload($storyFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.story_x'), config('attr.poster.story_y'), 'story-' . $imagename, 'webp');
            $model->story = $uploaded_story;
        }

        $model->type = 'game';
        $model->title = $request->input('title');
        $model->title_sub = $request->input('title_sub');
        $model->slug = SlugService::createSlug(Post::class, 'slug', $request->input('title'));
        $model->tagline = $request->input('tagline');
        $model->overview = $request->input('overview');
        $model->release_date = $request->input('release_date');
        $model->runtime = $request->input('runtime');
        $model->vote_average = $request->input('vote_average');
        $model->scene_id = $request->input('scene_id') ?: null;
        $model->trailer = $request->input('trailer');
        $model->platform = $request->input('platform');
        $model->view = $request->input('view', '0');
        $model->imdb_id = $request->input('imdb_id');
        $model->tmdb_id = $request->input('tmdb_id');
        $model->tmdb_image = $request->input('tmdb_image');
        $model->arguments = $request->arguments;
        $model->meta_title = $request->input('meta_title');
        $model->meta_description = $request->input('meta_description');
        $model->featured = $request->input('featured', 'disable');
        $model->slider = $request->input('slider', 'disable');
        $model->member = $request->input('member', 'disable');
        $model->comment = $request->input('comment', 'disable');
        $model->user_id = Auth::id();

        // Set status based on user role
        if (Auth::user()->isAdmin()) {
            $model->status = $request->input('status', 'publish');
        } else {
            // Force 'draft' status for moderators
            $model->status = 'draft';
        }

        if ($model->status == 'publish') {
            $model->published_at = now();
        }
        // Added body
        $model->body = $request->input('body');
        // Added developer support
        $model->developer_name = $request->input('developer_name');
        $model->developer_link = $request->input('developer_link');
        // Added Repack Features
        $model->repack_features = $request->input('repack_features');
        $model->save();

        // Category
        $model->genres()->sync($request->genre);

        // Tag
        $tagArray = [];
        foreach (explode(',', $request->input('tag')) as $tag) {
            if ($tag) {
                $tagComponent = Tag::where('type', 'post')->firstOrCreate(['tag' => $tag, 'type' => 'post']);
                $tagArray[$tagComponent->id] = ['post_id' => $model->id, 'tagged_id' => $tagComponent->id];
            }
        }
        $model->tags()->sync($tagArray);

        // Video
        if ($request->has('video')) {
            foreach ($request->input('video') as $key) {
                if ($key['link']) {
                    $video = new PostVideo();
                    $video->label = $key['label'];
                    $video->type = $key['type'];
                    $video->link = $key['link'];
                    $model->videos()->save($video);
                }
            }
        }

        // Subtitle
        if ($request->has('subtitle')) {
            foreach ($request->input('subtitle') as $key) {
                if (!empty($key['link'])) {
                    $file = $key['link'];
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path(config('attr.poster.subtitle_path') . $folderDate . '/'), $fileName);
                    $subtitle = new PostSubtitle();
                    $subtitle->scene_id = $key['scene_id'];
                    $subtitle->link = $fileName;
                    $model->subtitles()->save($subtitle);
                }
            }
        }

        // People
        if ($request->has('people')) {
            foreach ($request->input('people') as $key) {
                $traitPeople = $this->PeopleTmdb($key);
                if (!empty($traitPeople->id)) {
                    $model->peoples()->attach($traitPeople->id);
                }
            }
        }

        return redirect()->route('admin.game.index')->with('success', __(':title created', ['title' => $request->input('title')]));
    }

    public function edit($id)
    {
        $model = Post::findOrFail($id);

        $this->authorize('update', $model);

        $config = [
            'title' => __('Game'),
            'route' => 'game',
            'nav' => 'game',
        ];

        $listing = $model;

        $tabs = [
            'overview' => __('Overview'),
            'video' => __('Video'),
            'people' => __('People'),
            'subtitle' => __('Subtitle'),
            'advanced' => __('Advanced'),
        ];

        $genres = Genre::get();
        $scenes = Scene::all();

        $fetch = [];

        $fetch['data'] = $this->postFetch($listing);
        foreach ($listing->peoples as $people) {
            $fetch['peoples'][] = $this->peoplesFetch($people);
        }
        foreach ($listing->videos as $video) {
            $fetch['videos'][] = $this->videosFetch($video);
        }
        foreach ($listing->downloads as $download) {
            $fetch['videos'][] = $this->videosFetch($download);
        }
        foreach ($listing->subtitles as $subtitle) {
            $fetch['subtitles'][] = $this->subtitlesFetch($subtitle);
        }

        return view('admin.post.form', compact('config', 'listing', 'tabs', 'genres', 'scenes', 'fetch'));
    }

    public function update(Request $request, $id)
    {
        $model = Post::findOrFail($id);

        $this->authorize('update', $model);

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'developer_name' => 'nullable|string|max:255',
            'developer_link' => 'nullable|url|max:255',
        ]);

        $oldStatus = $model->status;
        $folderDate = $model->created_at->format('m-Y');

        if ($request->hasFile('image') || $request->filled('image_url')) {
            $imagename = Str::random(10);
            $imageFile = $request->image ?? $request->input('image_url');
            $uploaded_image = fileUpload($imageFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.size_x'), config('attr.poster.size_y'), $imagename);
            fileUpload($imageFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.size_x'), config('attr.poster.size_y'), $imagename, 'webp');
            $model->image = $uploaded_image;
        }

        if ($request->hasFile('cover') || $request->filled('cover_url')) {
            $imagename = Str::random(10);
            $coverFile = $request->cover ?? $request->input('cover_url');
            $uploaded_cover = fileUpload($coverFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.cover_size_x'), config('attr.poster.cover_size_y'), 'cover-' . $imagename);
            fileUpload($coverFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.cover_size_x'), config('attr.poster.cover_size_y'), 'cover-' . $imagename, 'webp');
            $model->cover = $uploaded_cover;
        }

        if ($request->hasFile('slide') || $request->filled('slide_url')) {
            $imagename = Str::random(10);
            $slideFile = $request->slide ?? $request->input('slide_url');
            $uploaded_slide = fileUpload($slideFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.slide_x'), config('attr.poster.slide_y'), 'slide-' . $imagename);
            fileUpload($slideFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.slide_x'), config('attr.poster.slide_y'), 'slide-' . $imagename, 'webp');
            $model->slide = $uploaded_slide;
        }
        if ($request->hasFile('story') || $request->filled('story_url')) {
            $imagename = Str::random(10);
            $storyFile = $request->story ?? $request->input('story_url');
            $uploaded_story = fileUpload($storyFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.story_x'), config('attr.poster.story_y'), 'story-' . $imagename);
            fileUpload($storyFile, config('attr.poster.path') . $folderDate . '/', config('attr.poster.story_x'), config('attr.poster.story_y'), 'story-' . $imagename, 'webp');
            $model->story = $uploaded_story;
        }

        $model->type = 'game';
        $model->title = $request->input('title');
        $model->title_sub = $request->input('title_sub');
        if ($model->slug != $request->input('slug')) {
            $model->slug = SlugService::createSlug(Post::class, 'slug', $request->input('slug'));
        }
        $model->tagline = $request->input('tagline');
        $model->overview = $request->input('overview');
        $model->release_date = $request->input('release_date');
        $model->runtime = $request->input('runtime');
        $model->vote_average = $request->input('vote_average');
        $model->scene_id = $request->input('scene_id');
        $model->trailer = $request->input('trailer');
        $model->platform = $request->input('platform');
        $model->view = $request->input('view', '0');
        $model->imdb_id = $request->input('imdb_id');
        $model->tmdb_id = $request->input('tmdb_id');
        $model->tmdb_image = $request->input('tmdb_image');
        $model->meta_title = $request->input('meta_title');
        $model->meta_description = $request->input('meta_description');
        $model->arguments = $request->arguments;
        $model->featured = $request->input('featured', 'disable');
        $model->slider = $request->input('slider', 'disable');
        $model->member = $request->input('member', 'disable');
        $model->comment = $request->input('comment', 'disable');

        // Set status based on user role
        if (Auth::user()->isAdmin()) {
            $model->status = $request->input('status', 'publish');
        } else {
            // Force 'draft' status for moderators
            $model->status = 'draft';
        }

        if ($oldStatus != 'publish' && $model->status == 'publish') {
            $model->published_at = now();
        }

        // Added Body
        $model->body = $request->input('body');
        // Added developer support
        $model->developer_name = $request->input('developer_name');
        $model->developer_link = $request->input('developer_link');
        // Added Repack Features
        $model->repack_features = $request->input('repack_features');
        $model->save();

        // Dispatch PostJob if needed
        if (Auth::user()->isAdmin()) {
            PostJob::dispatch($model, $request->send_notification)->afterResponse();
        }

        // Category
        $model->genres()->sync($request->genre);

        // Tag
        $tagArray = [];
        foreach (explode(',', $request->input('tag')) as $tag) {
            if ($tag) {
                $tagComponent = Tag::where('type', 'post')->firstOrCreate(['tag' => $tag, 'type' => 'post']);
                $tagArray[$tagComponent->id] = ['post_id' => $model->id, 'tagged_id' => $tagComponent->id];
            }
        }
        $model->tags()->sync($tagArray);

        // Video
        if ($request->has('video')) {
            foreach ($request->input('video') as $key) {
                if (isset($key['id']) && $key['id'] && $key['link']) {
                    $getVideo = PostVideo::findOrFail($key['id']);
                    $getVideo->label = $key['label'];
                    $getVideo->type = $key['type'];
                    $getVideo->link = $key['link'];
                    $getVideo->save();
                } elseif ($key['link']) {
                    $model->videos()->create(['type' => $key['type'], 'link' => $key['link'], 'label' => $key['label']]);
                }
            }
        }

        // Subtitle
        if ($request->has('subtitle')) {
            foreach ($request->subtitle as $key) {
                if (isset($key['id']) && $key['id'] && !empty($key['link'])) {

                    $file = $key['link'];
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path(config('attr.poster.subtitle_path') . $folderDate . '/'), $fileName);

                    $getSubtitle = PostSubtitle::findOrFail($key['id']);
                    $getSubtitle->scene_id = $key['scene_id'];
                    $getSubtitle->link = $fileName;
                    $getSubtitle->save();
                } elseif (!empty($key['link'])) {

                    $file = $key['link'];
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path(config('attr.poster.subtitle_path') . $folderDate . '/'), $fileName);

                    $model->subtitles()->create(['scene_id' => $key['scene_id'], 'link' => $fileName]);
                }
            }
        }
        // People
        if ($request->has('people')) {
            $syncPeople = [];
            foreach ($request->input('people') as $key) {
                $traitPeople = $this->PeopleTmdb($key);
                if (!empty($traitPeople->id)) {
                    $syncPeople[] = $traitPeople->id;
                }
            }
            $model->peoples()->sync($syncPeople);
        }

        Cache::flush();
        return redirect()->route('admin.game.edit', $model->id)->with('success', __(':title updated', ['title' => $request->input('title')]));
    }

    public function destroy($id)
    {
        $model = Post::findOrFail($id);

        $this->authorize('delete', $model);

        // Delete hasMany and morphMany relationships
        $model->comments()->delete();
        $model->videos()->delete();
        $model->subtitles()->delete();
        $model->report()->delete();
        $model->logs()->delete();
        $model->reactions()->delete();

        // Detach many-to-many and polymorphic many-to-many relationships
        $model->tags()->detach();
        $model->peoples()->detach();
        $model->watchlist()->detach();

        // Finally, delete the post itself
        $model->delete();

        return redirect()->back()->with('success', __('Deleted'));
    }

    public function videoDestroy(Request $request)
    {
        $video = PostVideo::find($request->id);
        if ($video) {
            $post = $video->post;
            $this->authorize('update', $post);
            $video->delete();
        }
    }

    public function subtitleDestroy(Request $request)
    {
        $subtitle = PostSubtitle::find($request->id);
        if ($subtitle) {
            $post = $subtitle->post;
            $this->authorize('update', $post);
            $subtitle->delete();
        }
    }
}
