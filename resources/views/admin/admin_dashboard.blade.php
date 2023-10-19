@extends('layouts.app')

@section('content')

<div class="header">
    <div class="left-section-header">
      <div class="Invantry-logo">   
        <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
        <h1 class="logo-header">Invantry</h1>
      </div>
    </div>
    <div class="right-section-header">
      <div class="user-name"> Hi, admin_name.</div>
    </div>
  </div>

    <div class="page-content">
        <div class="left-window">
            <button>Button 1</button>
            <button>Button 2</button>
            <button>Button 3</button>
        </div>
    
        <div class="middle-window">
            <!-- Main content goes here -->
        </div>
    </div>
@endsection
