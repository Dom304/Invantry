<template>
    <div class="left-window-admin-dashboard">
        <button
            class="window-btn"
            :class="{ selected: currentwindow === 'user' }"
            @click="currentwindow = 'user'"
        >
            Users
        </button>
        <button
            class="window-btn"
            :class="{ selected: currentwindow === 'store' }"
            @click="currentwindow = 'store'"
        >
            Stores
        </button>
        <button
            class="window-btn"
            :class="{ selected: currentwindow === 'request' }"
            @click="currentwindow = 'request'"
        >
            Requests
        </button>
    </div>

    <div class="right-window-admin-dashboard">
        <user-table v-if="currentwindow === 'user'" :users="users" :logged-in-user-id="loggedInUserId"></user-table>
        <store-table v-else-if="currentwindow === 'store'" :stores="stores"></store-table>
        <!-- Add your Requests component here -->
    </div>
</template>


<script>
import StoreTable from "./StoreTable.vue";
import UserTable from "./UserTable.vue";

export default {
    name: "admin-dashboard",
    props: ["users", "stores", "requests", "loggedInUserId"],
    components: {
        StoreTable,
        UserTable,
    },
    mounted() {
        console.log(this.loggedInUserId);
    },
    data() {
        return {
            currentwindow: "user",
        };
    },
};
</script>
