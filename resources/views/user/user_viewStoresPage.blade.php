
@extends('layouts.app')

@section('content')
    
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
        <a href="#" class="store">
            <span class="store-name">Lowe's</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Best Buy</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Five Below</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Dick's Sporting Goods</span>
        </a>
        <a href="/stores/best-buy" class="store">
            <span class="store-name">Best Buy</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Five Below</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Golf Galaxy</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">The Vitamin Shoppe</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Gamestop</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Spirit Halloween</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Target</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Harris Teeter</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Food Lion</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Ikea</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Academy Sports + Outdoors</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">GetOutdoors Pedal & Paddle</span>
        </a>
        <a href="#" class="store">
            <span class="store-name">Dollar Tree</span>
        </a>
    </div>

    <div class="right-window">
        <!-- Content will be dynamically populated or can remain empty -->
    </div>

</div>

@endsection
