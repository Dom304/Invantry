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
        if (auth()->check()) {
            $this->validate($request, [
                'collection_name' => 'required|string',
            ]);
        }

        Collection::create([
            'user_id' => auth()->user()->id,
            'collection_name' => $request->input('collection_name'),
    ]);

        return redirect()->route('collections.create')->with('success', 'Collection created successfully.');
    }

    
    //Method to return collections as json object
    public function getAllCollectionsForWebsite() {
    $collections = Collection::all();
    return response()->json($collections);
}

}

