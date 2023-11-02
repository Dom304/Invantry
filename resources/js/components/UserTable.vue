<template>
    <div>
        <b-table striped hover :items="users" :fields="fields">
            <template #cell(actions)="row">
                <b-button size="sm" @click="showEditModal=true">Edit</b-button>
                <b-button v-if="row.item.id !== loggedInUserId" size="sm" variant="danger" @click="clickedDeleteUser(row.item)">Delete</b-button>
            </template>
        </b-table>
    </div>

    <Modal :show="showModal" :userId="selectedUser.id" :username="selectedUser.name" @close="showModal = false"
  @user-deleted-successfully="refreshTable"></Modal>
    <EditModal :show="showEditModal" @close="showEditModal = false" :user-data="selectedUser" @update-user="editUser"></EditModal>
</template>


<script>
import { BTable } from 'bootstrap-vue-3';
import Modal from './Modal.vue'
import EditModal from './EditModal.vue'

export default {
    name: 'user-table',

    props: ['users', 'loggedInUserId'],

    components: {
        Modal,
        EditModal
    },

    data() {
        return {
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

    mounted() {
        console.log(this.loggedInUserId);
    },

    methods: {
        clickedDeleteUser(user) {
            this.selectedUser = user;
            this.showModal = true;
        },

        editUser(user) {
            // handle edit user logic
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
