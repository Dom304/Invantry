<template>
    <div>
      <b-button @click="toggleBusy">Toggle Busy State</b-button>
          
      <b-table striped hover :items="manager_requests" :busy="isBusy" :fields="fields">
        <template #table-busy>
          <div class="text-center text-danger my-2">
            <b-spinner class="align-middle"></b-spinner>
            <strong>Loading...</strong>
          </div>
        </template>
  
        <template #cell(actions)="row">
          <b-button size="sm" @click="acceptRequest(row.item)">Accept</b-button>
          <b-button size="sm" variant="danger" @click="deleteUser(row.item)">Reject</b-button>
        </template>
      </b-table>
    </div>
    <ManagerModal :show="showModal" :userId="selectedUser.id" :username="selectedUser.name" @close="showModal = false"
  @user-deleted-successfully="refreshTable"></ManagerModal>
  </template>
<script>

import { BTable } from 'bootstrap-vue-3';
import ManagerModal from './ManagerModal.vue'
import EditModal from './EditModal.vue'

export default {
    name: 'request-table',
    props: ['manager_requests', 'loggedInUserId'],
    components: {
        ManagerModal,
        EditModal
    },
    data() {
        return {
            isBusy: false,
            selectedUser: {},
            showModal: false,
            showEditModal: false,
            fields: [
                { key: 'id', label: 'ID' },
                { key: 'user_id', label: 'User ID' },
                { key: 'store_name', label: 'Store Name' },
                { key: 'description', label: 'Proposal' },
                { key: 'actions', label: 'Actions' }
            ]
        }
    }, 

    mounted() {
    console.log(this.manager_requests);
    },

    methods: {
        
      acceptRequest(user) { // Rename the method
        this.selectedUser = user;
        this.showModal = true;
      },
      rejectUser(item) {
        // Handle the reject action here
      }

    }
}
</script>
