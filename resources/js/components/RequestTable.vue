<template>
  <div>
    <!-- For testing toggleBusy state -->
    <!-- <b-button @click="toggleBusy">Toggle Busy State</b-button> -->

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

    <b-table striped hover :items="tablePagination" :busy="isBusy" :fields="fields">
      <template #table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>

      <template #cell(actions)="row">
        <b-button size="sm" @click="acceptRequest(row.item)">Accept</b-button>
        <b-button size="sm" variant="danger" @click="rejectUser(row.item)">Reject</b-button>
      </template>
    </b-table>

    <b-pagination
        v-model="currentPage"
        :total-rows="filteredStores.length"
        :per-page="rowsPerPage"
        aria-controls="my-table"
    ></b-pagination>
  </div>
  <ManagerModal
    :show="showModal"
    :userId="selectedUser.id"
    :username="selectedUser.name"
    @close="showModal = false"
    @user-deleted-successfully="refreshTable"
  ></ManagerModal>
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
  props: ["manager_requests", "loggedInUserId"],
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
      searchColumn: "Store Name",
      searchQuery: "",
      selectedUser: {},
      showModal: false,
      fields: [
        { key: 'id', label: 'ID', searchable: true },
        { key: 'store_name', label: 'Store Name', searchable: true },
        { key: 'actions', label: 'Actions', searchable: false }
      ],
    };
  },

  computed: {
    columnOptions() {
      return this.fields
        .filter(f => f.searchable)
        .map(f => f.label);
    },

    filteredStores() {
      if (!this.searchQuery) {
        return this.manager_requests;
      }
      const searchKey = this.fields.find(f => f.label === this.searchColumn)?.key;
      return this.manager_requests.filter(request => {
        const value = String(request[searchKey]).toLowerCase();
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
    acceptRequest(request) {
      this.selectedUser = request;
      this.showModal = true;
    },
    rejectUser(request) {
      // Handle the reject action here
    },
  },
};
</script>

