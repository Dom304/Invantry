<!-- Homepage.vue (or whatever your main file is named) -->
<template>
  <div>
    <app-header @cart-clicked="handleCartClicked" />
    <side-window />
    <!-- Other homepage content goes here -->
  </div>
</template>

<script>
import AppHeader from './AppHeader.vue'; // Adjust the import path as needed
import SideWindow from './SideWindow.vue'; // Adjust the import path as needed

export default {
  name: 'Homepage',
  components: {
    AppHeader,
    //SideWindow,
  },
  methods: {
    handleCartClicked() {
      console.log('Cart clicked!'); // Placeholder action
    }

    // METHODS USED BY SIDE WINDOW
  }
  
}
</script>
