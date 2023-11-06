<template>
    <div>
      <b-button @click="toggleBusy">Toggle Busy State</b-button>
          
      <b-table striped hover :items="stores" :busy="isBusy" :fields="fields">
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
  name: 'store-items-table',
  props: ['items'],
  data() {
    return {
      isBusy: false,
      fields: [
        { key: 'id', label: 'ID' },
        { key: 'item_name', label: 'Item Name' },
        { key: 'item_description', label: 'Item Description' },
        { key: 'item_quantity', label: 'Quantity' },
        { key: 'item_price', label: 'Price' },
        { key: 'item_logo', label: 'Item Logo' },
      ],
    };
  },
  methods: {
    toggleBusy() {
      this.isBusy = !this.isBusy;
    },
  },
};
</script>

