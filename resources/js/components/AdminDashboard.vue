<template>
    <div class="left-window-admin-dashboard">
        <button class="window-btn" @click="currentwindow = 'user'">Users</button>
        <button class="window-btn" @click="currentwindow = 'store'">Stores</button>
        <button class="window-btn" @click="currentwindow = 'request'">Requests</button>
    </div>

    <div class="right-window-admin-dashboard">
        <user-table v-if="currentwindow === 'user'" :users="users"></user-table>
        <store-table v-else-if="currentwindow === 'store'" :stores="stores"></store-table>
        <!-- Add other components as needed with v-else-if conditions -->
    </div>
</template>

<script>
import StoreTable from "./StoreTable.vue";
import UserTable from "./UserTable.vue";

export default {
    name: 'admin-dashboard',
    props: [
        'users',
        'stores',],

    components: {
        StoreTable,
        UserTable
    },

    data() {
        return {
            currentwindow: 'user',
        }
    },
}
</script>
