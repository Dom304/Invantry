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
            @click="currentwindow = 'request'">
            Requests
        </button>
    </div>

    <div class="right-window-admin-dashboard">
        <user-table v-if="currentwindow === 'user'" 
                :users="users" 
                :logged-in-user-id="loggedInUserId" 
                ref="userTable"
                @refresh-users="fetchUsers"></user-table>
        <store-table v-else-if="currentwindow === 'store'" :stores="stores"></store-table>
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
    name: "admin-dashboard",
    props: ["initialUsers", "stores", "loggedInUserId"],
    components: {
        StoreTable,
        UserTable,
    },

    created() {
        this.users = this.initialUsers;
    },

    mounted() {
        
    },
    data() {
        return {
            currentwindow: "user",
            users: [],
        };
    },
    methods: {
        
        async fetchUsers() {
        try {
             // Fetch the updated users data from the database
             let response = await axios.get('/refresh');
              // Update the users data property with the new data
            this.users = response.data;
             } catch (error) {
                   console.error("Error fetching users:", error);
             } finally {
                 if (this.$refs.userTable) {
                     this.$refs.userTable.isBusy = false; // Set the table to not busy after fetching data
                }
            }
        },

    },
};
</script>
