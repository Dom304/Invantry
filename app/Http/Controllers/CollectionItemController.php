<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionItem;
use App\Models\Collection;
use App\Models\Item;
class CollectionItemController extends Controller
{
    public function index($collName)
    {
        $user = Auth::user();
        $collections = Collection::all();
        $collections = $user->collections;
        $collection = Collection::where('collection_name', $collName)->first();
        $allItems = Item::all();

        if (!$collection) {
            return view('user.user_viewStorePage');
        }
    $items = $collection->items;
    
    return view('user.user_collectionsPage', compact('items', 'user', 'collections', 'collName', 'allItems'));
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
