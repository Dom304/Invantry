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
    // public function index($collName)
    // {
    //     $user = Auth::user();
    //     $collections = Collection::all();
    //     $collections = $user->collections;
    //     $collection = Collection::where('collection_name', $collName)->first();
    //     $allItems =Item::all();
    //     $stores = Store::all();

    //     if (!$collection) {
    //         return view('user.user_collectionsPage', compact('items', 'user', 'collections', 'collName', 'allItems', 'collection'));        }
    // $items = $collection->items;
    
    // return view('user.user_collectionsPage', compact('items', 'user', 'collections', 'collName', 'allItems', 'collection'));
    // }
    
    public function index($collName, $id)
{
    $user = Auth::user();
    $collections = $user->collections;

    // Try to find a collection by ID
    $collection = Collection::find($id);

    // If no collection is found by ID, try to find it by collection_name
    if (!$collection) {
        $collection = Collection::where('collection_name', $collName)->first();
    }

    $allItems = Item::all();
    $stores = Store::all();
    $items = $collection->items;

    if (!$collection) {
        // Handle the case where no collection is found
        return view('user.user_collectionsPage', compact('items', 'user', 'collections', 'collName', 'id', 'allItems', 'collection'));
    }

    

    return view('user.user_collectionsPage', compact('items', 'user', 'collections', 'collName', 'id', 'allItems', 'collection'));
}

    public function destroy($collName, $id, $itemId)
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

        return redirect()->route('collection', ['collName' => $collName, 'id' => $collection->id])
            ->with('success', 'Item deleted successfully');
    }
//     public function addUser($collName)
// {
//     $user = Auth::user();
//     $collection = Collection::where('collection_name', $collName)->first();

//     if (!$collection) {
//         // Handle error or redirect as needed
//     }

//     // Check if the user is not already associated with the collection
//     if (!$user->collections->contains('id', $collection->id)) {
//         // Associate the user with the collection
//         $collectionConn = new Collection();
//         $collectionConn->user_id = $user->id;
//         $collectionConn->collection_name = $collName;
//         $collectionConn->save();

//         return redirect()->route('collection', ['collName' => $collName])
//             ->with('success', 'Collection added to user successfully');
//     }

//     return redirect()->route('collection', ['collName' => $collName])
//         ->with('error', 'User is already associated with the collection');
// }
public function addUser($collName, $id)
{
    $user = Auth::user();
    $collection = Collection::where('collection_name', $collName)->first();

    if (!$collection) {

    }

    if (!$user->collections->contains('collection_name', $collName)) {
        $collectionConn = new Collection();
        $collectionConn->user_id = $user->id;
        $collectionConn->collection_name = $collName;
        $collectionConn->save();

        return redirect()->route('collection', ['collName' => $collName, 'id' => $collection->id])
            ->with('success', 'Collection added to user successfully');
    }

    return redirect()->route('collection', ['collName' => $collName, 'id' => $collection->id])
        ->with('error', 'User is already associated with the collection');
}

}
