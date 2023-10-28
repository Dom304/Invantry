@extends('layouts.app')

@section('content')
    {{--<div id="app">
        <homepage></homepage> <!-- This is your Vue component -->
    </div>--}}
    


<div class="page-content">
        
    <div class="left-window">
        <div class="user-info">
            <div class="user-img">
                <i class="fa-solid fa-user"></i>
            </div>
            <span class="username">Hello {{ $user->name }}!</span>
        </div>
        <button class="menu-btn" id="stores-user-btn">Stores (user)</button>
        
        <!-- Collection Search -->
        <div class="collection-search-container">
            <input type="text" placeholder="Search Collections..." class="collection-search-bar" id="collection-search-bar-input">
        </div>

        <!-- Fetch Users collections -->
        @foreach($collections as $col)
        <a href="/collection/{{ $col->collection_name }}" class="playlist-btn">{{$col->collection_name}}</a>
        @endforeach
        
    </div> 

    <div class="middle-window">
    @foreach($stores as $store)
        <!-- href="/stores/store-name" -->
        <a href="/store/{{ $store->store_name }}" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Lowes-logo.png" alt="Store Logo">
            </div>
            
            <div class="store-info">
                <span class="store-name">{{ $store->store_name }}</span>
                <span class="store-subtext">{{ $store->store_description }}</span>
            </div>
            
        </a>
        @endforeach
    </div>
        
       

    <div class="right-window">
        <!-- Content will be dynamically populated or can remain empty -->
    </div>

</div>
</div>

@endsection
