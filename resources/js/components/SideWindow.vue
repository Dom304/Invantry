<!-- SideWindow.vue -->
<template>
    <div class="left-window">
      <div class="user-info">
        <div class="user-img">
          <i class="fa-solid fa-user"></i>
        </div>
        <span class="username">USERNAME</span>
      </div>
      <button 
        class="menu-btn" 
        :class="{ active: activeButton === 'stores' }" 
        @click="setActive('stores')"
      >
        Stores (buyer)
      </button>
  
      <!-- New Buttons -->
      <button 
        class="menu-btn" 
        :class="{ active: activeButton === 'myStore' }" 
        @click="setActive('myStore')"
      >
        My Store (manager)
      </button>
      <button 
        class="menu-btn" 
        :class="{ active: activeButton === 'requests' }" 
        @click="setActive('requests')"
      >
        Requests (mod)
      </button>
      <button 
        class="menu-btn" 
        :class="{ active: activeButton === 'usersMod' }" 
        @click="setActive('usersMod')"
      >
        Users (mod)
      </button>
      <button 
        class="menu-btn" 
        :class="{ active: activeButton === 'usersAdmin' }" 
        @click="setActive('usersAdmin')"
      >
        Users (admin)
      </button>
      <button 
        class="menu-btn" 
        :class="{ active: activeButton === 'allStores' }" 
        @click="setActive('allStores')"
      >
        All Stores (admin)
      </button>
  
      <div class="collection-search-container">
        <input type="text" placeholder="Search Collections..." class="collection-search-bar" id="collection-search-bar-input">
      </div>
      <button 
        class="menu-btn" 
        :class="{ active: activeButton === 'goingGym' }" 
        @click="setActive('goingGym')"
      >
        Going Gym
      </button>
    </div>
  </template>
  
  <script>
export default {
  name: 'SideWindow',
  data() {
    return {
      activeButton: '', // Keeps track of the currently active button
    };
  },
  methods: {
    setActive(buttonName) {
      this.activeButton = buttonName; // Sets the active button based on the clicked button
    },
  },
}
</script>

<style scoped>
/*SIDE WINDOW*/
.left-window {
  margin-top: 67px;
  width: 273px;
  background-color: #fff;
  padding: 20px;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.2);
  height: 100vh;
  overflow-y: auto;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1000;
}

.left-window .user-info {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  margin-bottom: 20px;
}

.left-window .username {
  font-size: 1.2em;
  color: #333;
}

.left-window button.menu-btn {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  background-color: rgb(233, 233, 233); /* default background color */
  color: black; /* default text color */
  border: none;
  cursor: pointer;
  text-align: left;
  font-weight: bold; /* make text bold */
}

.left-window button.menu-btn.active {
  background-color: #333; /* active background color */
  color: white; /* active text color */
}

.left-window .collection-search-container {
  margin-bottom: 20px;
}

.left-window .collection-search-bar {
  width: 100%;
  padding: 10px;
}
</style>