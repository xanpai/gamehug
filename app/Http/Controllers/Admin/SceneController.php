<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scene;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class SceneController extends Controller
{
    public function index(Request $request)
    {
        $config = [
            'title' => __('Scene Groups'),
            'nav' => 'settings',
            'route' => 'scene',
            'create' => true,
        ];

        // Filter
        $search = $request->input('q');
        $searchBy = in_array($request->input('search_by'), ['title']) ? $request->input('search_by') : 'title';
        $sort = in_array($request->sorting, ['asc', 'desc']) ? $request->sorting : 'desc';
        $perPage = config('attr.page_limit');

        // Query
        $listings = Scene::when($search, function ($query) use ($search) {
            return $query->searchUrl($search);
        })->orderBy('id', 'ASC')->paginate($perPage)->appends(['q' => $search, 'sort' => $sort]);

        return view('admin.scene.index', compact('config', 'listings'));
    }
    public function create()
    {
        $config = [
            'title' => __('Scene Group'),
            'nav' => 'settings',
            'route' => 'scene',
        ];

        return view('admin.scene.form', compact('config'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:25',
        ]);

        $model = new Scene();

        $model->name                = $request->input('name');
        $model->slug                = SlugService::createSlug(Scene::class, 'slug', $request->input('name'));
        $model->code                = $request->input('code');
        $model->flag                = $request->input('flag');
        $model->subtitle            = $request->input('subtitle','disable');
        $model->filter              = $request->input('filter','disable');
        $model->save();

        return redirect()->route('admin.scene.index')->with('success', __(':title created', ['title' => __('Scene Group')]));
    }

    public function edit($id)
    {
        $config = [
            'title' => __('Scene Group'),
            'nav' => 'settings',
            'route' => 'scene',
        ];


        $listing = Scene::where('id', $id)->firstOrFail() ?? abort(404);

        return view('admin.scene.form', compact('config', 'listing'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:25',
        ]);

        $model = Scene::findOrFail($id);
        $model->name               = $request->input('name');
        if($model->slug != $request->slug) {
            $model->slug                = SlugService::createSlug(Scene::class, 'slug', $request->input('name'));
        }
        $model->code                = $request->input('code');
        $model->flag                = $request->input('flag');
        $model->subtitle            = $request->input('subtitle','disable');
        $model->filter              = $request->input('filter','disable');
        $model->save();

        return redirect()->route('admin.scene.edit',$model->id)->with('success', __(':title updated', ['title' => __('Scene Group')]));
    }

    public function destroy($id)
    {
        Scene::find($id)->delete();

        return redirect()->back()->with('success', __('Deleted'));
    }
}
