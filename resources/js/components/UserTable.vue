<template>
    <div>
        <b-table striped hover :items="users" :fields="fields">
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
    name: 'user-table',
    props: ['users'],
    data() {
        return {
            fields: [
                { key: 'id', label: 'ID' },
                { key: 'role', label: 'Role' },
                { key: 'name', label: 'Name' },
                { key: 'email', label: 'Email' },
                { key: 'actions', label: 'Actions' }
            ]
        }
    },
    methods: {
        editUser(user) {
            // handle edit user logic
        },
        deleteUser(user) {
            // handle delete user logic
        }
    }
}
</script>
