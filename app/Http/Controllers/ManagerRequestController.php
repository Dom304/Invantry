<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagerRequest;
use App\Services\StoreService;

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

    public function acceptRequest(ManagerRequest $requestId)
    {

        $validatedData = [
            'manager_id' => $requestId->user_id,
            'store_name' => $requestId->store_name,
            'store_description' => $requestId->description,
        ];

        $this->storeService->createStore($validatedData);
        $requestId->delete();

        return redirect()->back()->with('success', 'Request accepted successfully');
    }
}
