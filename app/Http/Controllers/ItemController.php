<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
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
}
