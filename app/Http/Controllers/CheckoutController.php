<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Store;
use App\Models\Collection;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $collections = Collection::all();
        $stores = Store::all();
        $collections = $user->collections;
        $purchasedItems = Cart::with('item')->where('user_id', $user->id)->get();
        $message = 'Thank you for your purchase!';

        return view('user.user_checkoutPage', compact('user', 'collections', 'stores', 'purchasedItems', 'message'));
    }

    public function processCheckout(Request $request)
    {
        // Eventually want this to delete all items in the users cart

        // Redirect back to the checkout page with a success message
        return redirect()->route('user.user_checkoutPage')->with('success', 'Order successfully processed!');
    }
}