<?php

namespace App\Http\Controllers;

use App\Models\GameRequest;
use Illuminate\Http\Request;

class GameRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        GameRequest::create([
            'title' => $request->title,
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Game request submitted successfully!');
    }
}
