<!-- SideWindow.vue -->
<template>
  <div class="left-window">

    <div class="user-info">
      <div class="user-img">
        <i class="fa-solid fa-user"></i>
      </div>
      <span class="username">USERNAME</span>
    </div>

    <!-- Menu Buttons -->
    <button class="menu-btn" :class="{ active: activeButton === 'stores' }" @click="setActive('stores')">Stores (buyer)</button>
    <button class="menu-btn" :class="{ active: activeButton === 'myStore' }" @click="setActive('myStore')">My Store (manager)</button>
    <button class="menu-btn" :class="{ active: activeButton === 'requests' }" @click="setActive('requests')">Requests (mod)</button>
    <button class="menu-btn" :class="{ active: activeButton === 'usersMod' }" @click="setActive('usersMod')">Users (mod)</button>
    <button class="menu-btn" :class="{ active: activeButton === 'usersAdmin' }" @click="setActive('usersAdmin')">Users (admin)</button>
    <button class="menu-btn" :class="{ active: activeButton === 'allStores' }" @click="setActive('allStores')">All Stores (admin)</button>

    <!-- Collection Search -->
    <div class="collection-search-container">
      <input type="text" placeholder="Search Collections..." class="collection-search-bar" id="collection-search-bar-input">
    </div>
    

    <button 
      v-for="col in collections" 
      :key="col.id"
      class="menu-btn" 
      :class="{ active: activeButton === col.collection_name }" 
      @click="setActive(col.collection_name)">
      {{ col.collection_name }}
    </button>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'SideWindow',
  data() {
    return {
      activeButton: '', // Keeps track of the currently active button
      collections: [],
    };
  },
  mounted() {
    this.fetchCollections();  // We're telling our magic to fetch the collections!
  },
  methods: {
    setActive(buttonName) {
      this.activeButton = buttonName; // Sets the active button based on the clicked button
    },
    fetchCollections() {
      axios.get('/api/all-collections-for-website')
        .then(response => {
          this.collections = response.data; // We're putting our collections into the magic bag!
          
          console.log(response.data);

        });
    },
  },
}
</script>

<style scoped>
/* Side Window Styling */

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
  background-color: rgb(233, 233, 233);
  color: black;
  border: none;
  cursor: pointer;
  text-align: left;
  font-weight: bold;
}

.left-window button.menu-btn.active {
  background-color: #333;
  color: white;
}

.left-window .collection-search-container {
  margin-bottom: 20px;
}

.left-window .collection-search-bar {
  width: 100%;
  padding: 10px;
}

</style>
