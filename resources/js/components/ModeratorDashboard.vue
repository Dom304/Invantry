<template>
    <div class="left-window-admin-dashboard">
        <a href="/home" class="back-arrow">
            <i class="fa-solid fa-angle-left"></i>
            <span>Back</span>
        </a>


        <!-- <button
            class="window-btn"
            :class="{ selected: currentwindow === 'user' }"
            @click="currentwindow = 'user'">
            Users
        </button> -->

        <button class="window-btn" :class="{ selected: currentwindow === 'store' }" @click="currentwindow = 'store'">
            Stores
        </button>

        <button class="window-btn" :class="{ selected: currentwindow === 'request' }" @click="currentwindow = 'request'">
            Requests
        </button>
    </div>

    <div class="right-window-admin-dashboard">
        <!-- <user-table
            v-if="currentwindow === 'user'"
            :users="users"
            :logged-in-user-id="loggedInUserId"
        ></user-table> -->
        <store-table v-if="currentwindow === 'store'" :stores="stores" @refresh-stores="fetchStores"></store-table>
        <request-table v-else-if="currentwindow === 'request'" :manager-requests="managerRequests" @refresh-requests="fetchRequests"></request-table>
    </div>
</template>

<script>
import StoreTable from "./StoreTable.vue";
import UserTable from "./UserTable.vue";
import RequestTable from "./RequestTable.vue";

export default {
    name: "moderator-dashboard",
    props: {
        users: Array,
        stores: Array,
        managerRequests: Array,
        loggedInUserId: Number,
    },

    components: {
        StoreTable,
        UserTable,
        RequestTable,
    },

    created() {
        this.users = this.initialUsers;
    },

    mounted() {
        console.log(this.managerRequests);
    },

    data() {
        return {
            currentwindow: "store",
            users: [],
            isFetchingUsers: false,
        };
    },

    methods: {
        async fetchStores() {
            console.log("fetching stores");

            // try {
            //     let response = await axios.get('/refresh');
            //     // Update the users data property with the new data
            //     this.users = response.data;
            // } catch (error) {
            //     console.error("Error fetching users:", error);
            // } finally {
            //     this.isFetchingUsers = false;
            // }
        },

        async fetchRequests() {
            console.log("fetching requests");

            // try {
            //     let response = await axios.get('/refresh');
            //     // Update the users data property with the new data
            //     this.users = response.data;
            // } catch (error) {
            //     console.error("Error fetching users:", error);
            // } finally {
            //     this.isFetchingUsers = false;
            // }
        },
    }
};
</script>
