<template>
    <div class="left-window-container">
        <button 
            class="left-window-btn" 
            :class="{ active: activeButton === 'usersAdmin' }" 
            @click="setActive('usersAdmin')">
            Users (admin)
        </button>
        
        <button 
            class="left-window-btn" 
            :class="{ active: activeButton === 'allStores' }" 
            @click="setActive('allStores')">
            All Stores (admin)
        </button>
    </div>
</template>

<script>
export default {
    name: 'AdminLeftWindow',
    
methods: {
    showUsers() {
        AdminDashboardEventBus.$emit('show-component', 'users');
    },
    showStores() {
        AdminDashboardEventBus.$emit('show-component', 'stores');
    }
}

}
</script>
