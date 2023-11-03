@extends('layouts.app')

@section('content')

<div class="top-toolbar">
    <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
    <h1 class="app-name">Invantry</h1>
    <div class="search-container">
        <input type="text" placeholder="Search items, products, and stores" class="search-input" />
    </div>
    <div class="cart-container">
        <button class="cart-button" id="cart-btn" onclick="toggleActiveState('cart-btn', 'user.user_viewCartPage')" @click="onCartClick">
            <img src="/images/cart_icon.png" alt="Cart" /> 
        </button>
    </div>
</div>

<div class="cart-middle-window">
    <form method="POST" action="{{ route('manager.request.store') }}">
        @csrf

        <div>
            <label for="store_name">Store Name:</label>
            <input type="text" name="store_name" id="store_name" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        
        <button type="submit">Submit Request</button>
    </form>
</div>





@endsection