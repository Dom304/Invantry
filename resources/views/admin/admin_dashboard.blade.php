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
    <div class="user-name"> Hi, {{$user->name}}.</div>
  </div>
</div>

<div class="admin-page-content">
  <div class="left-window-admin-dashboard">
    <admin-left-window></admin-left-window>
  </div>

  <div class="right-window-admin-dashboard">
    <!-- <admin-users-window></admin-main-window> -->
    <user-table></user-table>
    <store-table></store-table>
  </div>
</div>

@endsection