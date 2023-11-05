@extends('layouts.app')

@section('content')

<script>
    function filterCollections() {
        const searchInput = document.getElementById('collection-search-bar-input').value.toLowerCase();
        const collectionItems = document.querySelectorAll('.collection-btn');

        collectionItems.forEach(item => {
            const collectionName = item.getAttribute('data-collection-name').toLowerCase();
            if (collectionName.includes(searchInput)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function toggleActiveState(buttonId, viewName) {
        // Remove active class from all buttons
        document.querySelectorAll('.menu-btn').forEach(btn => btn.classList.remove('active'));
        
        // Add active class to the clicked button
        document.getElementById(buttonId).classList.add('active');
        
        // Fetch and display the relevant view
        if (buttonId === 'user-btn') {
            window.location.href = '/home';
        } else if (buttonId === 'manager-btn') {
            // Do something for manager-btn
        } else if (buttonId === 'admin-btn') {
            // Do something for admin-btn
        } else if (buttonId === 'mod-btn') {
            // Do something for mod-btn
        } else if (buttonId === 'cart-btn'){
            window.location.href = 'cart';
        } else {
            // Optional: handle other cases or do nothing
        }
    }
</script>

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

<div class="left-window">
        <div class="user-info">
            <span class="user-img">
                <i class="fa-solid fa-user"></i>
            </span>
            <span class="username">{{ $user->name }}</span>
        </div>
        @if(auth()->user()->role == 'buyer' || auth()->user()->role == 'moderator')
        <button class="window-btn" id="user-btn" onclick="toggleActiveState('user-btn', 'user.user_viewStoresPage')">Stores (buyer)</button>
        @endif
        @if(auth()->user()->role == 'manager')
        <button class="window-btn" id="manager-btn" onclick="toggleActiveState('manager-btn', 'manager.manager_dashboard')">My Store (manager)</button>
        @endif
        @if(auth()->user()->role == 'admin')
        <button class="window-btn" id="admin-btn" onclick="toggleActiveState('admin-btn', 'admin.admin_dashboard')">Dashboard (admin)</button>
        @endif
        @if(auth()->user()->role == 'moderator')
        <button class="window-btn" id="mod-btn" onclick="toggleActiveState('mod-btn', 'moderator.moderator_dashboard')">Dashboard (moderator)</button>
        @endif

        <form action="{{ route('collections.create') }}" method="POST">
        @csrf

        <label for="collection-search-bar-input">_____________________________________</label>

        <div class="user-info">
        <span class="user-img">
               
            <span class="username">COLLECTION CREATION</span>
        </div>



        <div class="collection-search-container">
            <label for="collection_name"></label>
            <input type="text" placeholder="New Collection Name" name="collection_name" id='collection_name' class="collection-search-bar">
        </div>
        <button type="submit" class="window-btn">Create Collection</button>

        </form>

        <!-- Collection Search -->
        <div class="collection-search-container">
        <label for="collection-search-bar-input">_____________________________________</label>
        <div class="user-info">
        <span class="user-img">
               
            <span class="username">{{ $user->name }}'S COLLECTIONS</span>
        </div>
        
            <input type="text" placeholder="Search Collections..." class="collection-search-bar" id="collection-search-bar-input" oninput="filterCollections()">
        </div>

        <!-- Fetch Users collections -->
        @foreach($collections as $col)
        <a href="/collection/{{ $col->collection_name }}" class="collection-btn" data-collection-name="{{ $col->collection_name }}">{{ $col->collection_name }}</a>
        @endforeach

        <a href="/manager-request" class="apply-btn">Store manager? Click here.</a>


    </div>

    

    <div class="cart-middle-window">
        <div class="cart-window" role="region" aria-label="Shopping Cart">

    
    <!-- Sample cart product #1 -->
    @foreach($cartItems as $cartItem)
    <div class="cart-product">
        <div class="product-details">
            <div class="product-name">{{ $cartItem->item->item_name }}</div>
            <div class="product-description">{{ $cartItem->item->item_description }}</div>
        </div>
        <div class="product-quantity">Quantity: {{ $cartItem->quantity }}</div>
        <div class="product-price">${{ number_format($cartItem->item->item_price, 2) }} each</div>
        <form method="POST" action="{{ route('cart.remove', $cartItem->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="fas fa-trash-alt trash-icon" aria-label="Remove product" role="button" tabindex="0"></button>
        </form>
    </div>
    @endforeach


    <!-- Cart Total -->
    @php
    $totalPrice = $cartItems->sum(function ($cartItem) {
        return $cartItem->quantity * $cartItem->item->item_price;
    });
    @endphp 

    <div class="cart-total"> ${{ number_format($totalPrice, 2) }}</div>
    

            <!-- Proceed to Checkout Button -->
            <button class="proceed-checkout" aria-label="Proceed to checkout">Proceed to Checkout</button>
        </div>
    </div>

    <div class="right-window"></div>
</div>

@endsection
