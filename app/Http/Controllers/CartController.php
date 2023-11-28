<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Store;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
    $user = Auth::user();
    $collections = Collection::all();
    $stores = Store::all();
    $collections = $user->collections;
    $cartItems = Cart::with('item')->where('user_id', $user->id)->get();

    return view('user.user_viewCartPage', compact('stores', 'collections', 'user', 'cartItems'));
    }

    public function insert(Request $request, $storeName)
    {
        $itemData = $request->all();
        $store = Store::where('store_name', $storeName)->firstOrFail();
        $existingCart = Cart::where('user_id', auth()->user()->id)
        ->where('store_id', $store->id)
        ->where('item_id', $itemData['item_id'])
        ->first();

    if ($existingCart) {
        $existingCart->increment('quantity');
    } else {
        Cart::create([
            'user_id' => auth()->user()->id,
            'store_id' => $store->id,
            'item_id' => $itemData['item_id'],
            'quantity' => 1,
        ]);
    }

        return redirect()->route('store', ['storeName' => $storeName])
        ->with('success', 'Item added to cart successfully');
    }

    //for inserting item to cart from right window
    public function insertRight(Request $request, $collName, $id)
    {
        $itemData = $request->all();
        $collections = Collection::where('collection_name', $collName)->firstOrFail();
        $existingCart = Cart::where('user_id', auth()->user()->id)
            ->where('store_id', $collections->id)
            ->where('item_id', $itemData['item_id'])
            ->first();
    
        if ($existingCart) {
            $existingCart->increment('quantity');
        } else {
            $item = Item::find($itemData['item_id']);
            $store_id = $item->store_id;
    
            Cart::create([
                'user_id' => auth()->user()->id,
                'store_id' => $store_id,
                'item_id' => $itemData['item_id'],
                'quantity' => 1,
            ]);
        }
    
        return redirect()->route('collection', ['collName' => $collName, 'id' => $collections->id])
            ->with('success', 'Item added to cart successfully');
    }


//for inserting item to collection from storePage
public function insertCol(Request $request, $storeName)
{
    $itemData = $request->all();
    $selectedCollectionId = $request->input('collection_id');

    // Check if the item already exists in the selected collection
    $existingItemInCollection = CollectionItem::where('collection_id', $selectedCollectionId)
        ->where('item_id', $itemData['item_id'])
        ->first();

    if (!$existingItemInCollection) {
        // If the item doesn't exist in the collection, create a new entry
        CollectionItem::create([
            'collection_id' => $selectedCollectionId,
            'item_id' => $itemData['item_id'],
        ]);
    }

    return redirect()->route('store', ['storeName' => $storeName])
        ->with('success', 'Item added to collection successfully');
}

    //for inserting item to collection from right window
    public function insertRightCol(Request $request, $collName, $id)
{
    $itemData = $request->all();
    $selectedCollectionId = $request->input('collection_id');
    $collections = Collection::where('collection_name', $collName)->firstOrFail();

    // Check if the item already exists in the selected collection
    $existingItemInCollection = CollectionItem::where('collection_id', $selectedCollectionId)
        ->where('item_id', $itemData['item_id'])
        ->first();

    if (!$existingItemInCollection) {
        // If the item doesn't exist in the collection, create a new entry
        CollectionItem::create([
            'collection_id' => $selectedCollectionId,
            'item_id' => $itemData['item_id'],
        ]);
    }

    return redirect()->route('collection', ['collName' => $collName, 'id' => $collections->id])
        ->with('success', 'Item added to collection successfully');
}
    

    public function remove(Cart $cartItem)
{
    if (!$cartItem) {
        return redirect()->route('cart')->with('error', 'Item not found.');
    }

    $cartItem->delete();

    return redirect()->route('cart')->with('success', 'Item removed from the cart');
}
}