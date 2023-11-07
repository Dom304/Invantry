<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Store;
use App\Models\Collection;
use App\Models\Cart;

class ItemController extends Controller
{
    public function index($storeName)
    {
    $user = Auth::user();
    $store = Store::where('store_name', $storeName)->firstOrFail();
    $items = Item::where('store_id', $store->id)->get();
    $collections = Collection::all();
    $collections = $user->collections; 
    $stores = Store::all();

    return view('user.user_storePage', compact('store','items', 'collections', 'stores', 'user', 'storeName'));
    }

    public function getStoreItems()
    {
    $user = Auth::user(); // Get the currently authenticated user
    $store = $user->store; // Assuming there is a "store" relationship on the User model

    if (!$store) {
        // Handle the case where the user doesn't have an associated store
        return redirect()->route('route_to_handle_no_store_association');
    }

    // Fetch items for the user's associated store
    $storeItems = $store->items;

    return view('manager.manager_storeInventoryPage', compact('stores', 'storeItems'));
    }
    
    public function insertItem(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:store,id',
            'item_name' => 'required|string',
            'item_description' => 'required|string',
            'item_quantity' => 'required|integer',
            'item_price' => 'required|numeric',
        ]);

        Item::create($request->all());

        return redirect()->back()->with('success', 'Item added successfully');
    }

    public function insertToCart(Request $request, $storeName)
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

        return redirect()->route('cart', ['storeName' => $storeName])
        ->with('success', 'Item added to cart successfully');
    }

    public function editItem(Request $request, Item $item)
    {
        $request->validate([
            'store_id' => 'required|exists:store,id',
            'item_name' => 'required|string',
            'item_description' => 'required|string',
            'item_quantity' => 'required|integer',
            'item_price' => 'required|numeric',
        ]);

        $item->update($request->all());

        return redirect()->back()->with('success', 'Item updated successfully');
    }

    public function deleteItem(Item $item)
    {
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    //for right window
    public function getAllItems() {
        $allItems = Item::all();
        return $allItems;
    }
    
}
