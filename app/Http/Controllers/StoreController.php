<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Models\Item;
use App\Models\Store;
use App\Models\Collection;
use App\Models\User;
use App\Models\ManagerRequest;


class StoreController extends Controller
{

    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

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
        $validatedData = $request->validate([
            'manager_id' => 'required|exists:users,id',
            'store_name' => 'required|string',
            'store_description' => 'required|string',
        ]);

        $this->storeService->createStore($validatedData);


        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    public function updateStore(Request $request, Store $store)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'manager_id' => 'required|exists:users,id|exists:users,id,role,manager',
            'store_description' => 'required|string',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $store->update([
            'store_name' => $request->input('store_name'),
            'manager_id' => $request->input('manager_id'),
            'store_description' => $request->input('store_description'),
        ]);

        if ($request->hasFile('store_logo')) {
            $storeLogoPath = $request->file('store_logo')->store('store_logos', 'public');
            $store->update(['store_logo' => $storeLogoPath]);
        }

        return response()->json(['message' => 'Store updated successfully']);
    }

    public function addItem(Request $request, Store $store)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'required|string',
            'item_quantity' => 'required|integer|min:1',
            'item_price' => 'required|numeric|min:0.01',
            'item_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $itemLogoPath = $request->file('item_logo')->store('item_logos', 'public');

        $item = $store->items()->create([
            'item_name' => $request->input('item_name'),
            'item_description' => $request->input('item_description'),
            'item_quantity' => $request->input('item_quantity'),
            'item_price' => $request->input('item_price'),
            'item_logo' => $itemLogoPath,
        ]);

        return redirect()->route('managerDashboard')->with('success', 'Item added successfully!');
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

    public function deleteStore($request)
    {
        $store = Store::find($storeId);

        if (!$store) {
            return response()->json(['message' => 'Store not found'], 404);
        }

        $store->delete();

        return response()->json(['message' => 'Store deleted successfully']);
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

        if ($user->isAdmin()) {
            $users = User::all();
            $stores = Store::all();
            $manager_requests = ManagerRequest::all();
            return view('admin.admin_dashboard', compact('user', 'users', 'stores', 'manager_requests'));
        }
        return redirect()->route('home');
    }

    public function moderatorDashboard()
    {
        $user = Auth::user();

        if ($user->isModerator()) {
            $users = User::all();
            $requests = ManagerRequest::all();
            $stores = Store::all();
            $manager_requests = ManagerRequest::all();
            $manager_requests = ManagerRequest::all();

            return view('moderator.moderator_dashboard', compact('user', 'users', 'stores', 'manager_requests'));
        }
        return redirect()->route('home');
    }

    public function managerDashboard()
    {
        $user = Auth::user();

        if ($user->isManager()) {
            $store = $user->store;
            $items = $store->items;

            return view('manager.manager_dashboard', compact('user', 'store', 'items'));
        }

        return redirect()->route('home');
    }

    public function deleteItem(Store $store, Item $item)
    {
        $item->delete();

        return redirect()->route('managerDashboard')->with('success', 'Item deleted successfully!');
    }

    public function returnUsers()
    {
        $users = User::all();
        return response()->json($users);
    }


    public function updateUser(Request $request, $userId)
    {

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|max:255',
        ]);

        $data['updated_at'] = now();

        $user->update($data);

        return response()->json($user);
    }
}
