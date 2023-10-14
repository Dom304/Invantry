<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionItem;

class CollectionItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'item_id' => 'required|exists:items,id',
        ]);

        CollectionItem::create($request->all());

        return redirect()->route('collection_items.index')->with('success', 'Collection item created successfully.');
    }
}
