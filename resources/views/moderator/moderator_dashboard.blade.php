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
    <user-btn :username="{{ json_encode($user->name) }}"></user-btn>
  </div>
  
</div>

<div class="admin-page-content">
  <moderator-dashboard :users="{{ json_encode($users) }}" :stores="{{json_encode($stores)}}" :logged-in-user-id="{{ auth()->id() }}" :manager_requests="{{ json_encode($manager_requests) }}"></moderator-dashboard>
</div>

@endsection