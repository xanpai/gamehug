<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameRequest;
use Illuminate\Http\Request;

class RequestPostController extends Controller
{
    public function index(Request $request)
    {
        $config = [
            'title' => __('Game Requests'),
            'heading' => __('Game Requests'),
            'nav' => 'request',
            'route' => 'request',
        ];

        // Filter
        $search = $request->input('q');
        $searchBy = in_array($request->input('search_by'), ['title']) ? $request->input('search_by') : 'title';
        $sort = in_array($request->sorting, ['asc', 'desc']) ? $request->sorting : 'desc';
        $perPage = config('attr.page_limit');

        // Query
        $listings = GameRequest::when($search, function ($query) use ($search, $searchBy) {
            return $query->where($searchBy, 'like', '%' . $search . '%');
        })->orderBy('id', $sort)->paginate($perPage)->appends(['q' => $search, 'sort' => $sort]);

        return view('admin.request.index', compact('config', 'listings'));
    }

    public function destroy($id)
    {
        GameRequest::findOrFail($id)->delete();

        return redirect()->back()->with('success', __('Deleted'));
    }

    public function updateStatus(Request $request, $id)
    {
        $gameRequest = GameRequest::findOrFail($id);
        $gameRequest->status = $request->status;
        $gameRequest->save();

        return redirect()->back()->with('success', __('Status updated'));
    }
}
