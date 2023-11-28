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
            window.location.href = '/cart';
        } else if (buttonId === 'checkout-btn'){
            window.location.href = '/checkout'
        }else {
            // Optional: handle other cases or do nothing
        }
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
        <a href="/collection/{{ $col->collection_name }}/{{ $col->id }}" class="collection-btn" data-collection-name="{{ $col->collection_name }}">{{ $col->collection_name }}</a>
        @endforeach

        <a href="/manager-request" class="apply-btn">Store manager? Click here.</a>


    </div>










    <div class="checkout-window">
    <h1>Purchase Summary</h1>
    
    <!-- Display purchased items -->
    <!-- Display purchased items -->
    <ul class="purchased-items">
        <li>Order Details:</li>
        @foreach($purchasedItems as $item)
            <li class="item-detail">
                {{ $item->quantity }} x {{  $item->item->item_name }} 
                - Price: ${{ $item->item->item_price * $item->quantity }}
            </li>
        @endforeach
    </ul>


    <!-- Calculate and display total -->
    @php
    $totalPrice = collect($purchasedItems)->sum(function($item) {
        return $item->quantity * $item->item->item_price;
    });

    $uniqueStores = collect($purchasedItems)->pluck('item.store_id')->unique()->count();
    $deliveryFee = 15.00 + (5 * ($uniqueStores - 1));

    $grandTotal = $totalPrice + $deliveryFee;
    @endphp
    
    <div class="price-details">
        <p>Total Price of Items: ${{ $totalPrice }}</p>
        <p>Delivery Fee: ${{ $deliveryFee }}</p>
        <p>Total: ${{ $grandTotal }}</p>
    </div>


    <!-- Calculate and display delivery time -->
    @php
        $uniqueStores = collect($purchasedItems)->pluck('item.store_id')->unique()->count();
        $totalItems = count($purchasedItems);
        
        $deliveryTime = 2 * $uniqueStores + floor($totalItems / 3);
    @endphp



    <div class="delivery-info2">
        <p class="important-notice2">Estimated Delivery Time: <b>{{ $deliveryTime }} hours</b></p>
    </div>



    

    <p>***************************************************************************************</p>


    <div class="delivery-info2">
    <p><b>{{ $message }}</b></p>
    </div>

    <p>***************************************************************************************</p>

    <div class="delivery-info2">
        <p class="important-notice">Items received after 10pm or before 8am will be delivered the following day</p>
    </div>

    <!-- Continue Shopping Button -->
    <div class="continue-shopping">
        <button type="button" onclick="window.location.href='/home'">Continue Shopping</button>
    </div>

</div>  

<div class="right-window"></div>


@endsection



