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

    //For filtering store items in middle window
    function filterItems() {
        const searchInput = document.querySelector('.search-input').value.toLowerCase();
        const itemCards = document.querySelectorAll('.store-card');

        itemCards.forEach(card => {
            const itemName = card.querySelector('.store-name').textContent.toLowerCase();
            const itemDescription = card.querySelector('.store-subtext').textContent.toLowerCase();
            if (itemName.includes(searchInput) || itemDescription.includes(searchInput)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

</script>

<div class="top-toolbar">
    <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
      <h1 class="app-name">Invantry</h1>
      <div class="search-container">
      <input type="text" placeholder="Search items, products, and stores" class="search-input" oninput="filterItems()" />
      </div>
      <div class="cart-container">
        <button class="cart-button" @click="onCartClick">
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
        <button class="menu-btn" id="menu-btn">Stores (user)</button>
        <button class="menu-btn" id="menu-btn">My Store (manager)</button>
        <button class="menu-btn" id="menu-btn">Users (admin)</button>
        <button class="menu-btn" id="menu-btn">All Stores (admin)</button>
        <button class="menu-btn" id="menu-btn">Requests (moderator)</button>
        <button class="menu-btn" id="menu-btn">Users (moderator)</button>
        
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
    @foreach($items as $item)
        <!-- href="/stores/store-name" -->
        <a href="/" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Lowes-logo.png" alt="Store Logo">
            </div>
            <div class="store-info">
                <span class="store-name">{{ $item->item_name }}</span>
                <span class="store-subtext">{{ $item->item_description }}</span>
                <span class="store-subtext">{{ $item->item_price }}</span>
            </div>
        </a>
        @endforeach
    </div>
        
       

    <div class="right-window">
        <!-- Content will be dynamically populated or can remain empty -->
    </div>

</div>

@endsection
