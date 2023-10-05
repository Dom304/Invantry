
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
    <button class="stores-btn">Stores</button>
    <div class="playlist-search-container">
        <input type="text" placeholder="Search Playlists..." class="playlist-search-bar">
    </div>
    <button class="playlist-btn">Going Gym</button>
</div>

        
<div class="middle-window">
    <div class="store">
        <span class="store-name">Lowe's</span>
    </div>
    <div class="store">
        <span class="store-name">Best Buy</span>
    </div>
    <div class="store">
        <span class="store-name">Five Below</span>
    </div>
</div>

        
<div class="right-window">
    <!-- Content will be dynamically populated or can remain empty -->
</div>

    </div>
@endsection
