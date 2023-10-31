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
    $collections = Collection::all();
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

    public function updateRole(Request $request)
{
    $user = auth()->user(); // Get the currently authenticated user.

    // Check which button was clicked to determine the new role.
    $newRole = $request->input('role');

    // Ensure the new role is valid.
    if (in_array($newRole, [User::ROLE_BUYER, User::ROLE_MANAGER, User::ROLE_MOD, User::ROLE_ADMIN])) {
        $user->role = $newRole;
        $user->save();

        return redirect()->back()->with('success', 'Your role has been updated successfully.');
    }

    return redirect()->back()->with('error', 'Invalid role selection.');
}

    public function dashboard(){
        $user = Auth::user();
        return view('admin.admin_dashboard', compact('user'));
    }

}
