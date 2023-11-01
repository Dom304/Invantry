<template>
    <div>
      <b-button @click="toggleBusy">Toggle Busy State</b-button>
          
      <b-table striped hover :items="users" :busy="isBusy" :fields="fields">
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
export default {
    data() {
        return {
            isBusy: false,
            users: [
                { id: 1, name: 'Best Buy', manager: 'Jon Snow'},
                { id: 2, name: 'Get Outdoors', manager: 'Jane Smith' },
                { id: 3, name: 'Walmart', manager: 'John Doe' },
                { id: 4, name: 'Target', manager: 'Jane Smith' },
                { id: 5, name: 'Dicks Sporting Goods', manager: 'Bob Johnson'}
            ],
            fields: [
                { key: 'id', label: 'ID' },
                { key: 'name', label: 'Name' },
                { key: 'manager', label: 'Manager' },
                { key: 'actions', label: 'Actions' }
            ]
        }
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
