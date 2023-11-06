<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\StoreService;
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

    public function deleteStore(Store $store)
    {
        $store->delete();

        return redirect()->back()->with('success', 'Store deleted successfully');
    }

    public function updateStore(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'required|integer|exists:users,id',
        ]);

        try {
            // Find the store by ID
            $store = Store::findOrFail($id);

            // Update the store's details
            $store->name = $validatedData['name'];
            $store->manager_id = $validatedData['manager_id'];
            $store->save();

            return response()->json(['message' => 'Store updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating store'], 500);
        }
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
        $users = User::all();
        $stores = Store::all();
        $manager_requests = ManagerRequest::all();
        return view('admin.admin_dashboard', compact('user', 'users', 'stores', 'manager_requests'));
    }

    public function moderatorDashboard()
    {
        $user = Auth::user();
        $users = User::all();
        $requests = ManagerRequest::all();
        $stores = Store::all();
        $manager_requests = ManagerRequest::all();
        return view('moderator.moderator_dashboard', compact('user', 'users', 'stores', 'manager_requests'));
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