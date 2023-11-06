<template>
    <div>
        <b-form-group label="Search by:" class="mb-3">
        <b-row>
            <b-col cols="auto">
                <b-form-select v-model="searchColumn" :options="columnOptions"></b-form-select>
            </b-col>
            <b-col>
                <b-form-input
                    v-model="searchQuery"
                    type="search"
                    :placeholder="`Search by ${searchColumn}`"
                ></b-form-input>
            </b-col>
        </b-row>
    </b-form-group>

        <b-table striped hover :items="filteredUsers" :fields="fields">
            <template #cell(actions)="row">
    <b-button size="sm" @click="editSelectedUser(row.item)">Edit</b-button>
    <b-button v-if="row.item.id !== loggedInUserId" size="sm" variant="danger" @click="clickedDeleteUser(row.item)">Delete</b-button>
</template>
        </b-table>

        <b-pagination
            v-model="currentPage"
            :total-rows="filteredUsers.length"
            :per-page="rowsPerPage"
            aria-controls="my-table"
        ></b-pagination>
    </div>

    <Modal :show="showModal" :userId="selectedUser.id" :username="selectedUser.name" @close="showModal = false"
  @user-deleted-successfully="refreshTable"></Modal>
  <EditModal :show="showEditModal" @close="showEditModal = false" :userData="selectedUser" @update-user="editUser"></EditModal>
</template>

<script>
import { BTable, BFormInput, BFormGroup, BFormSelect, BPagination } from 'bootstrap-vue-3';
import Modal from './Modal.vue'
import EditModal from './EditModal.vue'

export default {
    name: 'user-table',

    props: ['users', 'loggedInUserId'],

    components: {
        Modal,
        EditModal,
        BFormInput,
        BPagination,
    },

    data() {
        return {
            currentPage: 1,
            rowsPerPage: 5,
            columns: ['id', 'name', 'role'], // column keys for searching
            searchColumn: 'Name', // default column to search by
            searchQuery: '',
            selectedUser: {},
            showModal: false,
            showEditModal: false,
            fields: [
                { key: 'id', label: 'ID' },
                { key: 'role', label: 'Role' },
                { key: 'name', label: 'Name' },
                { key: 'email', label: 'Email' },
                { key: 'actions', label: 'Actions' }
            ]
        }
    },

    computed: {

        // Generate options from the fields
        columnOptions() {
            return this.fields
                .filter(f => f.key === 'id' || f.key === 'name' || f.key === 'role')
                .map(f => f.label);
        },

        // Filter users based on the selected column and search query
       filteredUsers() {
            if (!this.searchQuery) {
                return this.users;
            }
            const searchKey = this.fields.find(f => f.label === this.searchColumn)?.key;
            return this.users.filter(user => {
                const value = String(user[searchKey]).toLowerCase();
                return value.includes(this.searchQuery.toLowerCase());
            });
        },

        paginatedUsers() {
            const start = (this.currentPage - 1) * this.rowsPerPage;
            const end = start + this.rowsPerPage;
            return this.filteredUsers.slice(start, end);
        },
    },

    methods: {
        clickedDeleteUser(user) {
            this.selectedUser = user;
            this.showModal = true;
        },

        editSelectedUser(user) {
        this.selectedUser = user;
        this.showEditModal = true;
        },

        editUser(user) {
            this.refreshTable();
            console.log("User updated successfully");
        },

        refreshTable() {
            
            axios.get('/refresh')
                .then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    console.error("There was an error fetching the users:", error);
                });
        },
    }
}
</script>