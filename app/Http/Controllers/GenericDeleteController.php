<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Item;
use App\Models\Collection;
use App\Models\Cart;
use App\Models\ManagerRequest;

class GenericDeleteController extends Controller
{
    public function delete($type, $id)
    {
        switch ($type) {
            case 'user':
                $model = User::find($id);
                break;
            case 'store':
                $model = Store::find($id);
                break;
            case 'request':
                $model = ManagerRequest::find($id);
                break;
            // ... other cases for different types
            default:
                return response()->json(['message' => 'Invalid type specified'], 400);
        }

        if (!$model) {
            return response()->json(['message' => 'Entity not found'], 404);
        }

        $model->delete();

        return response()->json(['message' => ucfirst($type) . ' deleted successfully']);
    }
}
