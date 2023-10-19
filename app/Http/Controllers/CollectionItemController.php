<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionItem;
use App\Models\Collection;
class CollectionItemController extends Controller
{
    public function index($collName)
    {
    // $collections = Collection::where('store_name', $storeName)->firstOrFail();
    // $items = Item::where('store_id', $store->id)->get();
    $collections = Collection::all();
    $collItems = CollectionItem::all();
    
    return view('user.user_collectionsPage', compact('collItems', 'collections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'item_id' => 'required|exists:items,id',
        ]);

        CollectionItem::create($request->all());

        return redirect()->route('collection_items.index')->with('success', 'Collection item created successfully.');
    }
}
