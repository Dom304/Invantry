@extends('layouts.app')

@section('content')

<script>
//for right window
$(document).ready(function() {
    $.get("/collection/{collName}/search-items-matching-description", function(data) {
        $(".right-window").empty();
        
        data.forEach(function(item) {
            let itemCard = `
                <div class="store-and-item-container">
                    <h4 class="store-name">${item.store_name}</h4>
                    <div class="item-card">
                        <img src="path_to_placeholder_image" alt="Store Logo">
                        <h5 class="item-name">${item.item_name}</h5>
                        <p class="item-description">${item.item_description}</p>
                        <p class="item-price">${item.item_price}</p>
                    </div>
                </div>
            `;
            $(".right-window").append(itemCard);
        });
    });
});



    //For filtering store items in middle window
    function filterItems() {
        const searchInput = document.querySelector('.search-input').value.toLowerCase();
        const itemCards = document.querySelectorAll('.colitem-card');

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

    $(document).ready(function() {
    // When the search button inside a colitem-card is clicked
    $(".search-colitem-btn").click(function() {
            let itemName = $(this).data('item-name');
            let itemDescription = $(this).data('item-description');

        // AJAX request to fetch matching items
        $.post("/collection/{collName}/search-items-matching-description", {
            itemName: itemName,
            itemDescription: itemDescription
        }, function(response) {
            // Clear the right window
            $(".right-window").empty();

            // Populate the right window with the fetched items
            response.forEach(function(item) {
                let itemCard = `
                    <div class="store-and-item-container">
                        <h4 class="store-name">${item.store_name}</h4>
                        <div class="item-card">
                            <img src="path_to_placeholder_image" alt="Store Logo">
                            <h5 class="item-name">${item.item_name}</h5>
                            <p class="item-description">${item.item_description}</p>
                            <p class="item-price">${item.item_price}</p>
                        </div>
                    </div>
                `;
                $(".right-window").append(itemCard);
            });
        });
    });
});




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
      <div>
        <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
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

    <div class="middle-window">

        {{--Displaying the collection name according to what current collections items are displaying--}}
        <h2>{{ $collName }}</h2>


        @foreach($items as $item)
    <div class="colitem-card">
        <div class="store-logo">
            <img src="../images/store-logos/Lowes-logo.png" alt="Store Logo">
        </div>
        <div class="store-info">
            <span class="store-name">{{ $item->item_name }}</span>
            <span class="store-subtext">{{ $item->item_description }}</span>
        </div>
        <!-- Added a data attribute to the button for easy identification -->
        <button class="search-colitem-btn" data-item-name="{{ $item->item_name }}" data-item-description="{{ $item->item_description }}">Search for item</button>
    </div>
@endforeach
    </div>
        
       

    <div class="right-window">
    @foreach($allItems as $item)
    <a href="/" class="item-card">
        <div class="store-logo">
            <!-- NOTE: You might want to link the actual store logo based on the store associated with the item -->
            <img src="../images/store-logos/Lowes-logo.png" alt="Store Logo">
        </div>
        <div class="store-info">
            <span class="store-name">{{ $item->item_name }}</span>
            <span class="store-subtext">{{ $item->item_description }}</span>
            <span class="store-subtext">${{ number_format($item->item_price, 2) }}</span>
        </div>
        <button class="add-to-cart-btn">Add to Cart</button>
    </a>
    @endforeach
    </div>

</div>

@endsection