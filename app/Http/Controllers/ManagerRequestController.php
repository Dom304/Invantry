<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagerRequest;
use App\Models\User;
use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Support\Facades\Log;

class ManagerRequestController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function create()
    {
        return view('user.user_managerRequestPage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string',
            'description' => 'required|string',
        ]);

        ManagerRequest::create([
            'user_id' => auth()->user()->id,
            'store_name' => $request->input('store_name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('manager.request.create')->with('success', 'Request added successfully');
    }

    public function rejectRequest(ManagerRequest $requestId)
    {
        $requestId->delete();

        return redirect()->back()->with('success', 'Request deleted successfully');
    }

    // public function acceptRequest(ManagerRequest $requestId)
    // {

    //     $validatedData = [
    //         'manager_id' => $requestId->user_id,
    //         'store_name' => $requestId->store_name,
    //         'store_description' => $requestId->description,
    //     ];

    //     $this->storeService->createStore($validatedData);
    //     $requestId->delete();

    //     return redirect()->back()->with('success', 'Request accepted successfully');
    // }
    public function acceptRequest(Request $request)
    {

        // Retrieve the manager request data sent from the frontend
        $requestData = $request->input('request');
        Log::info('Request Data:', $requestData);
        // Find the user who made the manager request
        $user = User::find($requestData['user_id']);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if the user is already a manager
        if ($user->role === 'manager') {
            return response()->json(['error' => 'User is already a manager'], 400);
        }

        // Update the user's role to 'manager'
        $user->update(['role' => 'manager']);

        // Create a new store with details from the manager request
        Store::create([
            'manager_id' => $user->id,
            'store_name' => $requestData['store_name'],
            'store_description' => $requestData['description'],
            'store_logo' => null, // Or a default value if you have one
        ]);


        // Optionally, find and delete the manager request from the database
        // This assumes that the ID of the manager request is also sent in the requestData
        $managerRequest = ManagerRequest::find($requestData['id']);
        if ($managerRequest) {
            $managerRequest->delete();
        }

        return response()->json(['success' => 'Request accepted successfully']);
    }
}
