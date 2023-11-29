<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionItem;
use App\Models\Collection;
use App\Models\Item;
use App\Models\Store;
class CollectionItemController extends Controller
{
    public function index($collName)
    {
        $user = Auth::user();
        $collections = Collection::all();
        $collections = $user->collections;
        $collection = Collection::where('collection_name', $collName)->first();
        $allItems =Item::all();
        $stores = Store::all();

        if (!$collection) {
            return view('user.user_viewStoresPage', compact('user', 'stores', 'collections', 'collName', 'allItems'));
        }
    $items = $collection->items;
    
    return view('user.user_collectionsPage', compact('items', 'user', 'collections', 'collName', 'allItems'));
    }
    
    public function destroy($collName, $itemId)
    {
        $collection = Collection::where('collection_name', $collName)->first();

        if (!$collection) {
            // Handle error or redirect as needed
        }

        $collectionItem = CollectionItem::where('collection_id', $collection->id)
            ->where('item_id', $itemId)
            ->first();

        if ($collectionItem) {
            $collectionItem->delete();
        }

        return redirect()->route('collection', ['collName' => $collName])
            ->with('success', 'Item deleted successfully');
    }
}
