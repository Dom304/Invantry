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
        // Check the buttonId and take action accordingly
        if (buttonId === 'user-btn') {
            window.location.href = '/home';
        } else if (buttonId === 'manager-btn') {
            window.location.href = '/ManagerDashboard';
        } else if (buttonId === 'admin-btn') {
            window.location.href = '/adminDashboard';
        } else if (buttonId === 'mod-btn') {
            window.location.href = '/ModeratorDashboard';
        } else if (buttonId === 'coll-btn') {
            window.location.href = '/Public-collections';
        } else if (buttonId === 'cart-btn'){
            window.location.href = '/cart';
        } else {
            // Optional: handle other cases or do nothing
        }
    }

    function proceedToCheckout() {

    window.location.href = '/checkout'
    axios.post('/checkout')
        .then(function (response) {
            // handle success
            console.log(response);
        })
        .catch(function (error) {
            // handle error
            console.error(error);
        });
}
</script>

<div class="top-toolbar">
    <a href="/home">
        <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
    </a>
    <h1 class="app-name">Invantry</h1>
    <div class="search-container">
        <input type="text" placeholder="Search items, products, and stores" class="search-input" oninput="filterStores()" />
      </div>
      <div class="cart-container">
        <button class="cart-button" id="cart-btn" onclick="toggleActiveState('cart-btn', 'user.user_viewCartPage')" @click="onCartClick">
          <img src="/images/cart_icon.png" alt="Cart" /> 
        </button>
    </div>
    <div>
        <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="log-out-btn">Logout</button>
        </form>
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
        <button class="window-btn" id="user-btn" onclick="toggleActiveState('user-btn', 'user.user_viewStoresPage')">Stores</button>
        @endif
        @if(auth()->user()->role == 'manager')
        <button class="window-btn" id="manager-btn" onclick="toggleActiveState('manager-btn', 'manager.manager_dashboard')">My Store</button>
        @endif
        @if(auth()->user()->role == 'admin')
        <button class="window-btn" id="admin-btn" onclick="toggleActiveState('admin-btn', 'admin.admin_dashboard')">Dashboard</button>
        @endif
        @if(auth()->user()->role == 'moderator')
        <button class="window-btn" id="mod-btn" onclick="toggleActiveState('mod-btn', 'moderator.moderator_dashboard')">Dashboard</button>
        @endif

        <button class="window-btn" id="coll-btn" onclick="toggleActiveState('coll-btn', 'public.public_collectionsPage')">View Public Collections</button>

        <form action="{{ route('collections.create') }}" method="POST">
        @csrf

        <label for="collection-search-bar-input">_________________________________</label>

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
        <label for="collection-search-bar-input">_________________________________</label>
        <div class="user-info">
        <span class="user-img">
               
            <span class="username">{{ $user->name }}'s COLLECTIONS</span>
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
                <button class="proceed-checkout" aria-label="Proceed to checkout" id="checkout-btn" onclick="proceedToCheckout()">Proceed to Checkout</button>
            </div>
    </div>

    <div class="right-window"></div>
</div>

@endsection
