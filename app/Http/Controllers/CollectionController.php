<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function createCollection(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'collection_name' => 'required|string',
        ]);

        Collection::create($request->all());

        return redirect()->route('collections.index')->with('success', 'Collection created successfully.');
    }
}
