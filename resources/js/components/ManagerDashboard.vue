<template>
    <div class="left-window-admin-dashboard">
        <a href="/home" class="back-arrow">
            <i class="fa-solid fa-angle-left"></i>
            <span>Back</span>
        </a>

        <button
            class="window-btn"
            :class="{ selected: currentwindow === 'store' }"
            @click="currentwindow = 'store'">
            Stores
        </button>

    </div>

    <div class="right-window-admin-dashboard">
        <store-table
            v-if="currentwindow === 'store'"
            :stores="stores"
        ></store-table>
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
