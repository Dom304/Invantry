@extends('layouts.app')

@section('content')

<div class="admin-header">
  <div class="left-section-header">
    <div class="Invantry-logo">
      <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
      <h1 class="logo-header">Invantry</h1>
    </div>
  </div>
  <div class="right-section-header">
    {{-- <div class="user-name-dropdown"> --}}
      {{-- <button class="user-name-btn">Hi, {{$user->name}} <i class="arrow-down-icon"></i></button>
      <div class="dropdown-content">
        <a href="/profile">Profile</a>
        <a href="/settings">Settings</a>
        <div class="logout-form">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
      </div>
    </div> --}}

    <user-btn :username="{{ json_encode($user->name) }}"></user-btn>
  </div>
</div>

<div class="admin-page-content">
  <admin-dashboard :users="{{ json_encode($users) }}" :stores="{{json_encode($stores)}}" :logged-in-user-id="{{ auth()->id() }}"></admin-dashboard>
</div>

@endsection
