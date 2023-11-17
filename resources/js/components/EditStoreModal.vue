<template>
    <div :class="{ 'modal-overlay': true, 'showing': show }">
        <div class="modal-body">
            <div class="model-head">
                <h5>Edit Store</h5>
                <span aria-hidden="true" @click="close">&times;</span>
            </div>

            <div class="model-main-content">
                <form @submit.prevent="editStore">
                    <label for="storename">Store Name</label>
                    <input type="text" id="storename" v-model="updateInfo.store_name">

                    <label for="description">Description</label>
                    <input type="text" id="description" v-model="updateInfo.store_description">

                    <label for="manager_id">Manager ID</label>
                    <input type="number" id="manager_id" v-model.number="updateInfo.manager_id">

                    <button type="submit">Save Changes</button>
                </form>
            </div>

            <div class="model-foot">
                <button @click="close">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'edit-modal',
    emits: ['close', 'storeUpdated'],
    props: {
        show: {
            type: Boolean,
            default: false
        },
        storeData: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            updateInfo: { ...this.storeData }
        };
    },

    watch: {
        storeData: {
            deep: true,
            handler(newVal) {
                this.updateInfo = { ...newVal };
            }
        }
    },

    methods: {
        close() {
            this.$emit('close');
        },

        async editStore() {
            axios.post(`/updateStore/${this.updateInfo.id}`, {
                store_name: this.updateInfo.store_name,
                manager_id: this.updateInfo.manager_id,
                store_id: this.updateInfo.id,
                store_description: this.updateInfo.store_description,
            })
            .then(response => {
                this.$emit('storeUpdated');
                this.close();
            })
            .catch(error => {
                console.error("There was an error updating the store:", error);
            });
        },
    }
}
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
}

.modal-overlay.showing {
    opacity: 1;
    pointer-events: auto;
}

.modal-body {
    background: white;
    width: 60%;
    max-width: 600px;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    transform: translateY(-100%);
    transition: transform 0.3s ease-out;
}

.modal-overlay.showing .modal-body {
    transform: translateY(0);
}

.model-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #e5e5e5;
    text-align: center;
}

.model-head span {
    cursor: pointer;
    padding: 5px;
    display: inline-block;
}

.model-head span:hover {
    color: #888;
}

.model-main-content {
    padding: 20px;
    justify-content: center;
    padding: 20px 0;

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
}

.model-foot {
    display: flex;
    justify-content: space-between;
    padding-top: 20px;
    border-top: 1px solid #e5e5e5;
}
</style>
