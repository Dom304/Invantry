<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagerRequest;

class ManagerRequestController extends Controller
{
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
}
