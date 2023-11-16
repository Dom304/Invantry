@extends('layouts.app')

@section('content')

<script>
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
     //For filtering store items in right window
function filterItemsRight() {
    const searchInput = document.querySelector('.right-search-input').value.toLowerCase();
    const itemCards = document.querySelectorAll('.item-card2');  // Corrected the selector

    // Check if the search input is empty
    if (searchInput === '') {
        // If search input is empty, hide all cards
        itemCards.forEach(card => {
            card.style.display = 'none';
        });
    } else {
        // If search input is not empty, proceed with the existing filter logic
        itemCards.forEach(card => {
            const itemName = card.querySelector('.store-name').textContent.toLowerCase();
            const itemDescription = card.querySelector('.store-info .store-subtext').textContent.toLowerCase();  // Corrected the selector
            if (itemName.includes(searchInput) || itemDescription.includes(searchInput)) {
                card.style.display = 'flex';  // Changed from 'flex' to 'block' to match the display style of the item cards
            } else {
                card.style.display = 'none';
            }
        });
    }
}

function setSearchValueAndFilterRight(itemName) {
    // Set the search value in the right window search box
    document.getElementById('right-search-bar').value = itemName;

    // Trigger the filtering for the right window
    filterItemsRight();
}




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

    function confirmDeletion(collectionId) {
    if(confirm('Are you sure you want to delete this collection?')) {
        // If the user clicks "Yes", send a POST request to delete the collection
        fetch('/collection/delete/' + collectionId, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Assuming you have a meta tag for CSRF token
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: collectionId })
        })
        .then(response => {
            if(response.ok) {
                // If the deletion is successful, you might want to remove the collection from the DOM or refresh the page
                window.location.reload();
            } else {
                alert('There was an error trying to delete the collection.');
            }
        });
    } else {
        // If the user clicks "No", just return
        return;
    }
}





</script>

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="top-toolbar">
    <a href="/home">
        <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
    </a>
    <h1 class="app-name">Invantry</h1>
    <div class="search-container">
        <input type="text" placeholder="Search items, products, and stores" class="search-input" oninput="filterItems()" />
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
        <a href="/collection/{{ $col->collection_name }}" class="collection-btn" data-collection-name="{{ $col->collection_name }}">{{ $col->collection_name }}</a>
        @endforeach

        <a href="/manager-request" class="apply-btn">Store manager? Click here.</a>


    </div>

    

    <div class="middle-window">

        {{--Displaying the collection name according to what current collections items are displaying--}}
        <h2>{{ $collName }}</h2>
        <button class="delete-collection-btn" onclick="confirmDeletion('{{ $col->id }}')">Delete Collection</button>



        @foreach($items as $item)
    <div class="colitem-card">
        <div class="store-logo">
            <img src="{{$item->item_logo}}" alt="Store Logo">
        </div>
        <div class="store-info">
            <span class="store-name">{{ $item->item_name }}</span>
            <span class="store-subtext">{{ $item->item_description }}</span>
        </div>
        <!-- Added a data attribute to the button for easy identification -->
        <button class="search-colitem-btn" onclick="setSearchValueAndFilterRight('{{ $item->item_name }}')" data-item-name="{{ $item->item_name }}" data-item-description="{{ $item->item_description }}">Search for item</button>
        <form action="{{ route('deleteItem', ['store' => $item->store_id, 'item' => $item->id]) }}" method="post" class="delete-form">
            @csrf
            @method('delete')
            <button type="submit" class="delete-colitem-btn">Delete</button>
        </form>
    </div>
@endforeach
    </div>
        
       

    <div class="right-window">
    <div class="search-container">
        <input type="text" id="right-search-bar" placeholder="Search items, products, and stores" class="right-search-input" oninput="filterItemsRight()" />
    </div>
    {{--If the right-search-bar is empty, dont display any cards, otherwise (meaning if there is text in the search box) go through with the following loop that displays the cards--}}
    @foreach($allItems as $item)
    <div class="item-card2">
        <div class="store-logo">
            <img src="{{$item->item_logo}}" alt="Store Logo">
        </div>
        <div class="store-info">
            <span class="store-name">{{ $item->item_name }}</span>
            <span class="store-subtext">{{ $item->item_description }}</span>
            <span class="store-subtext">${{ number_format($item->item_price, 2) }}</span>
            <span class="store-subtext">Store Name: {{ $item->store->store_name }}</span>
        </div>
        
        <form method="POST" action="{{ route('collection.add', ['collName' => $collName]) }}">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <select name="collection_id" required>
        @foreach($collections as $collection)
            <option value="{{ $collection->id }}">{{ $collection->collection_name }}</option>
        @endforeach
    </select>
    <button type="submit" class="add-to-collection-btn">Add to Collection</button>
</form>


        <form method="POST" action="{{ route('collection', ['collName' => $collName]) }}">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="add-to-cart-btn">Add to Cart</button>
        </form>

        


    </div>
    @endforeach
</div>

</div>

@endsection