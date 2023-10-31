@extends('layouts.app')

@section('content')

<script>
    //For filtering collections in left window
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

    //For filtering stores in the middle window
    function filterStores() {
        const searchInput = document.querySelector('.search-input').value.toLowerCase();
        const storeCards = document.querySelectorAll('.store-card');

        storeCards.forEach(card => {
            const storeName = card.querySelector('.store-name').textContent.toLowerCase();
            const storeDescription = card.querySelector('.store-subtext').textContent.toLowerCase();
            if (storeName.includes(searchInput) || storeDescription.includes(searchInput)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
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
            // Do something for manager-btn
        } else if (buttonId === 'admin-btn') {
            // Do something for admin-btn
        } else if (buttonId === 'mod-btn') {
            // Do something for mod-btn
        } else if (buttonId === 'cart-btn'){
            window.location.href = '/cart';
        } else {
            // Optional: handle other cases or do nothing
        }
    }
</script>

<div class="top-toolbar">
    <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
    <h1 class="app-name">Invantry</h1>
    <div class="search-container">
        <input type="text" placeholder="Search items, products, and stores" class="search-input" oninput="filterStores()" />
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
        <button class="menu-btn" id="user-btn" onclick="toggleActiveState('user-btn', 'user.user_viewStoresPage')">Stores (buyer)</button>
        @endif
        @if(auth()->user()->role == 'manager')
        <button class="menu-btn" id="manager-btn" onclick="toggleActiveState('manager-btn', 'manager.manager_dashboard')">My Store (manager)</button>
        @endif
        @if(auth()->user()->role == 'admin')
        <button class="menu-btn" id="admin-btn" onclick="toggleActiveState('admin-btn', 'admin.admin_dashboard')">Dashboard (admin)</button>
        @endif
        @if(auth()->user()->role == 'moderator')
        <button class="menu-btn" id="mod-btn" onclick="toggleActiveState('mod-btn', 'moderator.moderator_dashboard')">Dashboard (moderator)</button>
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

    <div class="middle-window">
        @foreach($stores as $store)
        <!-- href="/stores/store-name" -->
        <a href="/store/{{ $store->store_name }}" class="store-card">
            <div class="store-logo">
                <img src="{{ $store->store_logo }}" alt="Store Logo">
            </div>

            <div class="store-info">
                <span class="store-name">{{ $store->store_name }}</span>
                <span class="store-subtext">{{ $store->store_description }}</span>
            </div>

        </a>
        @endforeach

    <form method="POST" action="{{ route('updateRole') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="role" value="manager">
        <button type="submit">Manager Button</button>
    </form>

<form method="POST" action="{{ route('updateRole') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="role" value="moderator">
    <button type="submit">Mod Button</button>
</form>

<form method="POST" action="{{ route('updateRole') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="role" value="admin">
    <button type="submit">Admin Button</button>
</form>

    </div>



    <div class="right-window">
        <!-- Content will be dynamically populated or can remain empty -->
    </div>

</div>
</div>

@endsection