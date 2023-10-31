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
        editUser(user) {
            // handle edit user logic
        },
        deleteUser(user) {
            // handle delete user logic
        }
    }
}
</script>
