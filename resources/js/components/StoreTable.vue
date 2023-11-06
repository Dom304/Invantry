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

      <!-- Just for testing the toggle busy state -->
      <!-- <b-button @click="toggleBusy">Toggle Busy State</b-button> -->

      <b-table striped hover :items="tablePagination" :busy="isBusy" :fields="fields">
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

      <b-pagination
        v-model="currentPage"
        :total-rows="filteredStores.length"
        :per-page="rowsPerPage"
        aria-controls="my-table"
    ></b-pagination>

  </div>
</template>

<script>
import { BTable, BFormInput, BFormGroup, BFormSelect, BRow, BCol,  BPagination } from 'bootstrap-vue-3';

export default {
  name: 'store-table',
  props: ['stores'],
  components: {
        BPagination,
  },

  data() {
      return {
          isBusy: false,
          currentPage: 1,
          rowsPerPage: 5, // adjust as needed
          searchColumn: 'Store Name', // default column to search by
          searchQuery: '',
          fields: [
              { key: 'id', label: 'ID' },
              { key: 'store_name', label: 'Store Name' },
              { key: 'actions', label: 'Actions' }
          ],
          columns: ['id', 'store_name'] // column keys for searching
      }
  }, 

  computed: {
          // get the column options for the search select
        columnOptions() { 
            return this.fields
                .filter(f => f.key === 'id' || f.key === 'store_name')
                .map(f => f.label);
        },

      // filter the stores based on the search query
      filteredStores() {
            if (!this.searchQuery) {
                return this.stores;
            }
            const searchKey = this.fields.find(f => f.label === this.searchColumn)?.key;
            return this.stores.filter(store => {
                const value = String(store[searchKey]).toLowerCase();
                return value.includes(this.searchQuery.toLowerCase());
            });
        },

        tablePagination() {
            const start = (this.currentPage - 1) * this.rowsPerPage;
            const end = start + this.rowsPerPage;
            return this.filteredStores.slice(start, end);
        },
    },

  methods: {
      deleteUser(user) {
          // handle delete user logic
      },
      
      editUser(user) {
          // handle edit user logic
      },

      toggleBusy() {
          this.isBusy = !this.isBusy;
      },
  }
}
</script>