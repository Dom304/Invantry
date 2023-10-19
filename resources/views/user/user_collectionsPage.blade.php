
@extends('layouts.app')

@section('content')
    <div id="app">
        <homepage></homepage> <!-- This is your Vue component -->
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
        @foreach($collections as $col)
        <button href="/{{ $col->collection_name }}" class="playlist-btn">{{$col->collection_name}}</button>
        @endforeach
    </div>

    <div class="middle-window">
    @foreach($CollItems as $item)
        <!-- href="/stores/store-name" -->
        <a href="/col/{{ $item->item_id }}" class="store-card">
            <div class="store-logo">
                <img src="../images/store-logos/Lowes-logo.png" alt="Store Logo">
            </div>
            <div class="store-info">
                <span class="store-name"></span>
                <span class="store-subtext"></span>
            </div>
        </a>
        @endforeach
    </div>
        
       

    <div class="right-window">
        <!-- Content will be dynamically populated or can remain empty -->
    </div>

</div>

@endsection