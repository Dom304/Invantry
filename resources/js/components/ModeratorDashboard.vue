<template>
    <div class="left-window-admin-dashboard">
        <a href="/home" class="back-arrow">
    <i class="fa-solid fa-angle-left"></i>
    <span>Back</span>
</a>


        <button
            class="window-btn"
            :class="{ selected: currentwindow === 'user' }"
            @click="currentwindow = 'user'">
            Users
        </button>

        <button
            class="window-btn"
            :class="{ selected: currentwindow === 'store' }"
            @click="currentwindow = 'store'">
            Stores
        </button>

        <button
            class="window-btn"
            :class="{ selected: currentwindow === 'request' }"
            @click="currentwindow = 'request'">
            Requests
        </button>
    </div>

    <div class="right-window-admin-dashboard">
        <user-table
            v-if="currentwindow === 'user'"
            :users="users"
            :logged-in-user-id="loggedInUserId"
        ></user-table>
        <store-table
            v-else-if="currentwindow === 'store'"
            :stores="stores"
        ></store-table>
        <request-table
            v-else-if="currentwindow === 'request'"
            :manager_requests="manager_requests"
        ></request-table>
    </div>
</template>

<script>
import StoreTable from "./StoreTable.vue";
import UserTable from "./UserTable.vue";
import RequestTable from "./RequestTable.vue";

export default {
    name: "moderator-dashboard",
    props: ["users", "stores", "manager_requests", "loggedInUserId"],
    components: {
        StoreTable,
        UserTable,
        RequestTable,
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
