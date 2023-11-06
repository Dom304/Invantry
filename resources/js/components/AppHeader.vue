<!-- AppHeader.vue -->
<template>
    <header class="header">
      <img src="/images/Button_backpack_logo.png" alt="Logo" class="logo" />
      <h1 class="app-name">Invantry</h1>
      <div class="search-container">
        <input type="text" placeholder="Search items, products, and stores" class="search-input" />
      </div>
      <div class="cart-container">
        <button class="cart-button" @click="onCartClick">
          <img src="/images/cart_icon.png" alt="Cart" /> 
        </button>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'AppHeader',
    methods: {
      onCartClick() {
        this.$emit('cart-clicked');
      },
    },
  }
  </script>

  