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
    $user = Auth::user();
    $collections = $user->collections;
    $allCollections = Collection::whereNotIn('collection_name', $collections->pluck('collection_name'))->get();
    return view('public.public_collectionsPage', compact('collections', 'user', 'allCollections'));
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

    //for deleting a collection
    public function delete($id)
{
    try {
        $collection = Collection::findOrFail($id);
        $collection->delete();
        return response()->json(['success' => 'Collection deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error occurred while deleting collection'], 500);
    }
}


    
    //Method to return collections as json object
    public function getAllCollectionsForWebsite() {
    $collections = Collection::all();
    return response()->json($collections);
}

}

