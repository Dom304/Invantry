<template>
    <div class="left-window-admin-dashboard">
        <!-- <a href="/home" class="back-arrow">
            <i class="fa-solid fa-angle-left"></i>
            <span>Back</span>
        </a> -->
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
            @click="currentwindow = 'request'">
            Requests
        </button>
    </div>

    <div class="right-window-admin-dashboard">
        <user-table v-if="currentwindow === 'user'" 
                :users="users" 
                :logged-in-user-id="loggedInUserId" 
                ref="userTable"
                :is-busy="isFetchingUsers"
                @refresh-users="fetchUsers"></user-table>
        <store-table v-else-if="currentwindow === 'store'" :stores="stores" :is-busy="isFetchingStore" @refresh-stores="fetchStores"></store-table>
        <request-table v-else-if="currentwindow === 'request'" :manager-requests="managerRequests" :is-busy="isFetchingRequests" @refresh-requests="fetchRequests"></request-table>
    </div>
</template>


<script>
import StoreTable from "./StoreTable.vue";
import UserTable from "./UserTable.vue";
import RequestTable from "./RequestTable.vue";

export default {
    name: "admin-dashboard",
    props: {
        initialUsers: Array,
        users: Array,
        initialStores: Array,
        initialRequests: Array,
        loggedInUserId: Number,
    },
    components: {
        StoreTable,
        UserTable,
        RequestTable,
    },

    created() {
        this.users = this.initialUsers;
        this.stores = this.initialStores;
        this.managerRequests = this.initialRequests;
    },

    mounted() {
        
    },
    
    data() {
        return {
            currentwindow: "user",
            users: [],
            stores: [],
            managerRequests: [],
            isFetchingUsers: false,
            isFetchingRequests: false,
            isFetchingStore: false,
        };
    },
    methods: {
    async fetchUsers() {
        this.isFetchingUsers = true;
        try {
            let response = await axios.get('/refresh', { params: { type: 'users' } });
            // Update the users data property with the new data
            this.users = response.data;
        } catch (error) {
            console.error("Error fetching users:", error);
        } finally {
            this.isFetchingUsers = false;
        }
    },

    async fetchStores() {
        console.log("fetching stores");
        this.isFetchingStore = true;
        try {
            let response = await axios.get('/refresh', { params: { type: 'stores' } });
            // Update the users data property with the new data
            this.stores = response.data;
        } catch (error) {
            console.error("Error fetching stores:", error);
        } finally {
            this.isFetchingStore = false;
        }
    },

        async fetchRequests() {
            console.log("fetching requests");
            this.isFetchingRequests = true;
        try {
            let response = await axios.get('/refresh', { params: { type: 'manager_requests' } });
            // Update the users data property with the new data
            this.managerRequests = response.data;
        } catch (error) {
            console.error("Error fetching requests:", error);
        } finally {
            this.isFetchingRequests = false;
        }
        },
}

};
</script>