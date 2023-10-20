<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Collection;
use App\Models\User;


class StoreController extends Controller
{

    public function index()
    {
    $user = Auth::user();
    $stores = Store::all();
    $collections = $user->collections;

    return view('user.user_viewStoresPage', compact('stores', 'collections', 'user'));
    }

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
