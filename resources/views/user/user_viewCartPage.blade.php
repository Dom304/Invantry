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

<div class="page-content">
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

        <!-- Collection Search -->
        <div class="collection-search-container">
            <input type="text" placeholder="Search Collections..." class="collection-search-bar" id="collection-search-bar-input" oninput="filterCollections()">
        </div>

        <!-- Fetch Users collections -->
        @foreach($collections as $col)
        <a href="/collection/{{ $col->collection_name }}" class="collection-btn" data-collection-name="{{ $col->collection_name }}">{{ $col->collection_name }}</a>
        @endforeach

    </div>

    <div class="cart-middle-window">
        <div class="cart-window" role="region" aria-label="Shopping Cart">

    
    <!-- Sample cart product #1 -->
    <div class="cart-product">
        <div class="product-details">
            <div class="product-name">Product Name 1</div>
            <div class="product-description">Short description of the product</div>
        </div>
        <div class="product-quantity">Quantity: 2</div>
        <div class="product-price">$9.99 each</div>
        <i class="fas fa-trash-alt trash-icon" aria-label="Remove product" role="button" tabindex="0"></i>

    </div>

    <!-- Sample cart product #2 -->
    <div class="cart-product">
        <div class="product-details">
            <div class="product-name">Product Name 2</div>
            <div class="product-description">Another description of the product</div>
        </div>
        <div class="product-quantity">Quantity: 1</div>
        <div class="product-price">$19.99 each</div>
        <i class="fas fa-trash-alt trash-icon" aria-label="Remove product" role="button" tabindex="0"></i>

    </div>
    

    <!-- Cart Total -->


    <div class="cart-total">Total: $39.97</div>
    

            <!-- Proceed to Checkout Button -->
            <button class="proceed-checkout" aria-label="Proceed to checkout">Proceed to Checkout</button>
        </div>
    </div>

    <div class="right-window"></div>
</div>

@endsection
