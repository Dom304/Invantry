<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
    $collections = Collection::all();

    return view('user.user_viewStoresPage', compact('collections'));
    }
    
    public function createCollection(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'collection_name' => 'required|string',
        ]);

        Collection::create($request->all());

        return redirect()->route('collections.index')->with('success', 'Collection created successfully.');
    }

    
    //Method to return collections as json object
    public function getAllCollectionsForWebsite() {
    $collections = Collection::all();
    return response()->json($collections);
}

}

