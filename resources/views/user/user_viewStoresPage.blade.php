
@extends('layouts.app')

@section('content')
    <div id="app">
        <homepage></homepage> <!-- This is your Vue component -->
    </div>
    
<div class="top-toolbar">
    <div class="logo-container">
        <img src="{{ asset('images/Button_backpack_logo.png') }}" alt="Website Logo" class="logo">
        <span class="website-name">Invantry</span>
    </div>
    <div class="search-container">
        <input type="text" placeholder="Search..." class="search-bar">
    </div>
    <div class="cart-container">
        <button class="cart-btn">Cart</button>
    </div>
</div>

<div class="page-content">
        
    <div class="left-window">
        <div class="user-info">
            <span class="username">Username</span>
        </div>
        <button class="stores-btn" id="stores-user-btn">Stores</button>
        <div class="playlist-search-container">
            <input type="text" placeholder="Search Playlists..." class="playlist-search-bar" id="playlist-search-bar-input">
        </div>
        <button class="playlist-btn">Going Gym</button>
    </div>

    <div class="middle-window">
        <!-- href="/stores/store-name" -->
        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Lowes-logo.png" alt="Store Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Lowe's</span>
                <span class="store-subtext">Lawn & Garden • Hardware • Home Decor</span>
            </div>
        </a>
        
        
        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/BestBuy-Logo.png" alt="Store Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Best Buy</span>
                <span class="store-subtext">Electronics • Home & Office</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Five-Below-logo.png" alt="Store Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Five Below</span>
                <span class="store-subtext">Toys & Tech • Beauty & Fashion • Home & Gifts • Value Finds</span>
            </div>
        </a>
        
        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Dicks-Sporting-Goods-logo.png" alt="Store Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Dick's Sporting Goods</span>
                <span class="store-subtext">Athletic Apparel • Team Sports • Outdoor Gear</span>
            </div>
        </a>

        
        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="Golf Galaxy">
            </div>
            <div class="store-info">
                <span class="store-name">Golf Galaxy</span>
                <span class="store-subtext">Outdoor Gear</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="The Vitamin Shoppe">
            </div>
            <div class="store-info">
                <span class="store-name">The Vitamin Shoppe</span>
                <span class="store-subtext">Health & Wellness • Supplements</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="Gamestop Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Gamestop</span>
                <span class="store-subtext">Video Games • Electronics</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Spirit-Halloween-logo.png" alt="Spirit Halloween Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Spirit Halloween</span>
                <span class="store-subtext">Costumes & Accessories • Party Supplies</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Target-logo.png" alt="Spirit Halloween Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Target</span>
                <span class="store-subtext">Home Essentials • Beauty & Fashion • Electronics & Toys</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="Harris Teeter Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Harris Teeter</span>
                <span class="store-subtext">Grocery Essentials • Home Essentials • Pharamacy</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="Food Lion Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Food Lion</span>
                <span class="store-subtext">Grocery Essentials • Home Essentials</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="IKEA Logo">
            </div>
            <div class="store-info">
                <span class="store-name">IKEA</span>
                <span class="store-subtext">Furniture</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="Academy Sports + Outdoors Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Academy Sports + Outdoors</span>
                <span class="store-subtext">Athletic Apparel • Team Sports • Outdoor Gear</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/GetOutside-Logo.png" alt="GetOutdoors Logo">
            </div>
            <div class="store-info">
                <span class="store-name">GetOutdoors Pedal & Paddle</span>
                <span class="store-subtext">Outdoor Gear</span>
            </div>
        </a>

        <a href="#" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/#" alt="GetOutdoors Logo">
            </div>
            <div class="store-info">
                <span class="store-name">Dollar Tree</span>
                <span class="store-subtext">Everyday Essentials • Grocery Essentials • Value Finds</span>
            </div>
        </a>
    </div>

    <div class="right-window">
        <!-- Content will be dynamically populated or can remain empty -->
    </div>

</div>

@endsection

<script src="{{ mix('js/app.js') }}"></script> <!-- Make sure this points to your compiled app.js -->
