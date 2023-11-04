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
          <b-button size="sm" @click="editUser(row.item)">Edit</b-button>
          <b-button size="sm" variant="danger" @click="deleteUser(row.item)">Delete</b-button>
        </template>
      </b-table>
    </div>
  </template>
<script>

import { BTable } from 'bootstrap-vue-3';
import Modal from './Modal.vue'
import EditModal from './EditModal.vue'

export default {
    name: 'request-table',
    props: ['manager_requests'],
    data() {
        return {
            isBusy: false,
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
        
        deleteUser(user) {
            // handle delete user logic
        },
        
        editUser(user) {
            // handle edit user logic
        },

        toggleBusy() {
        this.isBusy = !this.isBusy
      },

    }
}
</script>
