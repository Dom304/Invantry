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
  
  <style scoped>
/*TOP TOOLBAR*/
.header {
  display: flex;
  width: auto;
  justify-content: space-between;
  align-items: center;
  padding: 10px 30px;
  background-color: #fff;
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
}

.logo {
  max-height: 30px; 
  width: auto;
  margin-right: 30px; 
}

.app-name {
  margin-top: 10px; 
  margin-right: 60px; 
  font-size: 1.5em; 
}

.search-container {
  flex-grow: 2;
  margin-right: 220px;
  display: flex;
  align-items: center;
}

.search-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc; 
}

.cart-container {
  margin-left: 20px; 
}

.cart-button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  padding: 5px;
}

.cart-button img {
  width: 30px; 
  height: auto;
}
</style>

  