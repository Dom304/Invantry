<template>
    <div>

      <!-- HEADER / TOP TOOLBAR CONTENT -->
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

        <!-- SIDE WINDOW CONTENT -->
        <div class="left-window">
          <div class="user-info">
            <div class="user-img">
              <i class="fa-solid fa-user"></i>
            </div>
            
              <span class="username">USERNAME</span>
          </div>
          <button class="stores-btn" id="stores-user-btn">Stores</button>
          <div class="playlist-search-container">
              <input type="text" placeholder="Search Collections..." class="playlist-search-bar" id="playlist-search-bar-input">
          </div>
          <button class="playlist-btn">Going Gym</button>
      </div>
  
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
    //METHODS USED BY HEADER
    onCartClick() {
      // Define what happens when the cart is clicked
      console.log('Cart clicked!'); // Placeholder action
    }

    // METHODS USED BY SIDE WINDOW
  }
  
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
    flex-grow: 2; /* Lets search container to take up more space */
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

/*SIDE WINDOW*/

.left-window {
    margin-top: 67px;
    width: 273px; /* Adjust width as needed */
    background-color: #fff; /* Adjust color as needed */
    padding: 20px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.2);
    height: 100vh; /* Makes it full height */
    overflow-y: auto; /* Allows scrolling */
    position: fixed;/*  Keeps it in place */
    top: 0;
    left: 0;
    z-index: 1000; /* Adjust as needed to ensure it's above other content */
}

/* Additional styles for children elements if needed */
.left-window .user-info {
    display: flex; /* Establishes a flex context for its children */
    justify-content: center; /* Centers children horizontally */
    align-items: center; /* Centers children vertically */
    height: 50px; /* Give it a height, or it will be as tall as its content */
    margin-bottom: 20px; /* Adjust as needed */
}

.left-window .username {
    font-size: 1.2em; /* Adjust as needed */
    color: #333; /* Adjust color as needed */
}

.left-window button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px; /* Adjust as needed */
    background-color: #333; /* Adjust color as needed */
    color: white; /* Adjust color as needed */
    border: none;
    cursor: pointer;
    text-align: left;
}

.left-window .playlist-search-container {
    margin-bottom: 20px; /* Adjust as needed */
}

.left-window .playlist-search-bar {
    width: 100%;
    padding: 10px;
}

</style>
