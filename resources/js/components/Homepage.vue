<template>
    <div>
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
  
      <!-- Other homepage content goes here -->
    </div>
</template>
  
<script>
export default {
  name: 'Homepage',
  data() {
    return {
      // data properties here, like search text or number of items in cart
    };
  },
  methods: {
    onCartClick() {
      // Define what happens when the cart is clicked
      console.log('Cart clicked!'); // Placeholder action
    }
  }
  
}
</script>

<style scoped>
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 30px;
    background-color: #fff;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
  }

  .logo {
    max-height: 30px; 
    width: auto;
    margin-right: 40px; 
  }

  .app-name {
    margin-top: 10px; 
    margin-right: 40px; 
    font-size: 1.5em; 
  }

  .search-container {
    flex-grow: 2; /* Lets search container to take up more space */
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
