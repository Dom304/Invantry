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
              <b-button size="sm" style="margin-right: 5px;" @click="editStore(row.item)">Edit</b-button>
              <b-button size="sm" variant="danger" @click="deleteStore(row.item)">Delete</b-button>
          </template>
      </b-table>

      <b-pagination
        v-model="currentPage"
        :total-rows="filteredStores.length"
        :per-page="rowsPerPage"
        aria-controls="my-table"
    ></b-pagination>

    <!-- Todo: -->
    <Modal :show="showModal" 
                    :type="'store'"
                    :entityData="selectedStore"
                    @close="showModal = false"
                    @deleted-successfully="refreshStores">
    </Modal>

  <EditStoreModal :show="showEditModal"
                  @close="showEditModal = false"
                  :storeData="selectedStore"
                  @store-updated="refreshStores">
  </EditStoreModal>

  </div>
</template>

<script>
import { BTable, BFormInput, BFormGroup, BFormSelect, BRow, BCol,  BPagination } from 'bootstrap-vue-3';
import EditStoreModal from './EditStoreModal.vue';
import Modal from './Modal.vue';

export default {
  name: 'store-table',
  emits: ['refreshStores'],
  props: ['stores'],
  components: {
        BPagination,
        EditStoreModal,
        Modal,
  },

  data() {
      return {
          isBusy: false,
          currentPage: 1,
          rowsPerPage: 5,
          columns: ['id', 'store_name'],
          searchColumn: 'Store Name',
          searchQuery: '',
          showEditModal: false,
          showModal: false,
          selectedStore: {},
          fields: [
              { key: 'id', label: 'ID' },
              { key: 'manager_id', label: 'Manager ID'},
              { key: 'store_name', label: 'Store Name' },
              { key: 'store_description', label: 'Description'},
              { key: 'actions', label: 'Actions' }
          ]
      }
  }, 

  computed: {
          // get the column options for the search select
        columnOptions() { 
            return this.fields
                .filter(f => f.key === 'id' || f.key === 'store_name' || f.key === 'manager_id')
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
        editStore(store) {
            this.selectedStore = store;
            this.showEditModal = true;
        },

        handleStoreUpdated() {
            // Refresh your store data here if necessary
             this.showEditModal = false;
        },

      toggleBusy() {
          this.isBusy = !this.isBusy;
      },

      deleteStore(store) {
            console.log('deleteStore', store);
            this.selectedStore = store;
            this.showModal = true;
        },

        editSelectedStore(store) {
            this.selectedStore = store;
            this.showEditModal = true;
        },

        refreshStores() {
            this.$emit('refreshStores');
        },
  }
}
</script>