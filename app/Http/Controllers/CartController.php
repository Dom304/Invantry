<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Collection;
use App\Models\User;

class CartController extends Controller
{
    public function index()
    {
    $user = Auth::user();
    $collections = Collection::all();
    $stores = Store::all();
    $collections = $user->collections;

    return view('user.user_viewCartPage', compact('stores', 'collections', 'user'));
    }

    public function addToCart(Request $request, $productId)
    {
        // Add a product to the cart
    }

    public function updateCart(Request $request, $cartId)
    {
        // Update the quantity of a product in the cart
    }

    public function removeFromCart($cartId)
    {
        // Remove a product from the cart
    }
}