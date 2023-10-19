<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function createStore(Request $request)
    {
        $request->validate([
            'manager_id' => 'required|exists:users,id',
            'store_name' => 'required|string',
            'store_description' => 'required|string',
        ]);

        Store::create($request->all());

        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    public function deleteStore(Store $store)
    {
        $store->delete();

        return redirect()->back()->with('success', 'Store deleted successfully');
    }
}
