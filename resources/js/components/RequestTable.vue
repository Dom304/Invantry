<template>
  <div>
    <b-form-group label="Search by:" class="mb-3">
      <b-row>
        <b-col cols="auto">
          <b-form-select v-model="searchColumn" :options="columnOptions"></b-form-select>
        </b-col>
        <b-col>
          <b-form-input v-model="searchQuery" type="search" :placeholder="`Search by ${searchColumn}`"></b-form-input>
        </b-col>
      </b-row>
    </b-form-group>

    <b-table striped hover :items="tablePagination" :busy="isBusy" :fields="fields">
      <template #table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>

      <template #cell(actions)="row">
        <b-button size="sm" style="margin-right: 5px;" @click="acceptRequest(row.item)">Accept</b-button>
        <b-button size="sm" variant="danger" @click="rejectUser(row.item)">Reject</b-button>
      </template>
    </b-table>

    <b-pagination v-model="currentPage" :total-rows="filteredRequests.length" :per-page="rowsPerPage"
      aria-controls="my-table"></b-pagination>
  </div>
  <ManagerModal :show="showModal" :request="selectedRequest" @close="showModal = false"
    @user-deleted-successfully="refreshTable" @request-accepted-successfully="closeModal">
  </ManagerModal>
</template>

<script>
import {
  BTable,
  BFormInput,
  BFormGroup,
  BFormSelect,
  BRow,
  BCol,
  BPagination,
  BButton,
  BSpinner
} from "bootstrap-vue-3";
import ManagerModal from "./ManagerModal.vue";

export default {
  name: "request-table",
  props: {
    managerRequests: Array,
    loggedInUserId: Number,
  },
  components: {
    ManagerModal,
    BTable,
    BFormInput,
    BFormGroup,
    BFormSelect,
    BRow,
    BCol,
    BPagination,
    BButton,
    BSpinner
  },
  data() {
    return {
      isBusy: false,
      currentPage: 1,
      rowsPerPage: 5,
      searchColumn: "User ID", // Set the default search column here
      searchQuery: "",
      selectedRequest: {},
      showModal: false,
      fields: [
        { key: 'id', label: 'ID', searchable: true },
        { key: 'user_id', label: 'User ID', searchable: true },
        { key: 'store_name', label: 'Store Name', searchable: true },
        { key: 'description', label: 'Description', searchable: true },
        { key: 'actions', label: 'Actions' }
      ],
      columns: [],
    };
  },

  computed: {
    columnOptions() {
      return this.fields.filter(f => f.searchable).map(f => f.label);
    },
    filteredRequests() {
      if (!this.searchQuery) {
        return this.managerRequests;
      }
      const searchKey = this.fields.find(f => f.label === this.searchColumn)?.key;
      return this.managerRequests.filter(request => {
        const value = String(request[searchKey] ?? '').toLowerCase();
        return value.includes(this.searchQuery.toLowerCase());
      });
    },
    tablePagination() {
      const start = (this.currentPage - 1) * this.rowsPerPage;
      return this.filteredRequests.slice(start, start + this.rowsPerPage);
    },
  },
  methods: {
    acceptRequest(request) {
      this.selectedRequest = request;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    rejectRequest(request) {
      this.showModal = true;
    },
    refreshTable() {
      // Add logic to refresh table, possibly fetching data again
    },
  },
};
</script>