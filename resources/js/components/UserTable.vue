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
    data() {
        return {
            users: [
                { id: 1, role: 'Admin', name: 'John Doe', email: 'john.doe@example.com' },
                { id: 2, role: 'User', name: 'Jane Smith', email: 'jane.smith@example.com' },
                { id: 3, role: 'Moderator', name: 'Bob Johnson', email: 'bob.johnson@example.com' }
            ],
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
