@extends('layouts.app')

@section('content')
<div id="app">
    <homepage></homepage> 
</div>

<div class="page-content">
    
    <div class="left-window">
    </div>

    <div class="middle-window">
        <!-- Cart items (hardcoded for demonstration) -->
        <div class="cart-item" data-price="20" data-quantity="2">
            <h2 class="item-name">Item One</h2>
            <p class="item-description">Description for item one.</p>
            <p class="item-quantity">Quantity: 2</p>
            <p class="item-price">$20</p>
        </div>
        <div class="cart-item" data-price="15" data-quantity="3">
            <h2 class="item-name">Item Two</h2>
            <p class="item-description">Description for item two.</p>
            <p class="item-quantity">Quantity: 3</p>
            <p class="item-price">$15</p>
        </div>
        <div class="cart-item" data-price="10" data-quantity="1">
            <h2 class="item-name">Item Three</h2>
            <p class="item-description">Description for item three.</p>
            <p class="item-quantity">Quantity: 1</p>
            <p class="item-price">$10</p>
        </div>

        <!-- Total price container -->
        <div class="total-price">
            Total: <span>$0</span>
        </div>

        <!-- Proceed to checkout button -->
        <button class="checkout-btn">Proceed to Checkout</button>
    </div>

    <div class="right-window">
        <!-- Content will be dynamically populated or can remain empty -->
    </div>

</div>

<script>
(function calculateTotal() {
    let total = 0;
    const cartItems = document.querySelectorAll('.cart-item');
    
    if (cartItems.length === 0) {
        console.error("No cart items found!");
        return;
    }

    cartItems.forEach(function (item) {
        const price = Number(item.dataset.price);
        const quantity = Number(item.dataset.quantity);

        if (isNaN(price) || isNaN(quantity)) {
            console.error("Invalid price or quantity!", item);
            return; // This will skip to the next iteration in forEach loop
        }

        total += price * quantity;
    });

    const totalPriceElement = document.querySelector('.total-price span');
    if (!totalPriceElement) {
        console.error("Total price container not found!");
        return;
    }

    totalPriceElement.innerText = '$' + total.toFixed(2);
})(); // Call the function immediately
</script>
@endsection
