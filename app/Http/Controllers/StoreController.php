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

    public function deleteUser($id)
    {
        // Get the authenticated user's ID
        $authUserId = auth()->id();

        // Check if the user is trying to delete themselves
        if ($authUserId == $id) {
            return redirect()->back()->with('error', 'You cannot delete yourself!');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // TODO:Perform any pre-deletion tasks here. For example, deleting related entities or files.

        $user->delete();

        return redirect()->route('adminDashboard')->with('success', 'User deleted successfully.');
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

    public function adminDashboard()
    {
        $user = Auth::user();
        $users = User::all();  // Fetch all users, adjust the query as needed.
        $stores = Store::all();
        return view('admin.admin_dashboard', compact('user', 'users', 'stores'));
    }

    public function moderatorDashboard()
    {
        $user = Auth::user();
        $users = User::all();  // Fetch all users, adjust the query as needed.
        $stores = Store::all();
        return view('moderator.moderator_dashboard', compact('user', 'users', 'stores'));
    }

    public function returnUsers()
    {
        $users = User::all();
        return response()->json($users);
    }
}
