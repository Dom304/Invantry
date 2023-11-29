<template>
  <div :class="{ 'modal-overlay': true, 'showing': show }">
    <div class="modal-body">
      <div class="modal-head">
        <h5>Deletion Confirmation</h5>
        <span aria-hidden="true" @click="close">&times;</span>
      </div>
      <div class="modal-main-content">
        Are you sure you want to delete <strong>{{ entityData.store_name }}</strong>?
      </div>
      <div class="modal-foot">
        <button class="delete-btn" @click="deleteEnity">Delete</button>
        <button class="close-btn" @click="close">Cancel</button>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  name: 'delete-modal',
  emits: ['close', 'deleted-successfully'],
  props: {
    show: {
      type: Boolean,
      default: false
    },

    entityData: {
      type: Object,
      default: () => ({})
    },

    type: {
      type: String,
      default: ''
    }
  },

  methods: {
    close() {
      this.$emit('close');
    },

    deleteEnity() {
      axios.post(`/delete/${this.type}/${this.entityData.id}`, {
        id: this.entityData.id,
        type: this.type,
      })
        .then(response => {
          console.log(`${this.type} deleted successfully`);
          this.$emit('deleted-successfully');
          this.close();
        })
        .catch(error => {
          console.error(`There was an error deleting the ${this.type}:`, error);
        });
    }
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
  /* Initially set the overlay to be invisible */
  pointer-events: none;
  /* Ensure it doesn't block anything when not shown */
  transition: opacity 0.3s;
  /* Transition effect for fade-in */
}

.modal-overlay.showing {
  opacity: 1;
  pointer-events: auto;
  /* Restore pointer events when modal is shown */
}

.modal-body {
  background: white;
  width: 60%;
  max-width: 600px;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  transform: translateY(-100%);
  transition: transform 0.3s ease-out;
}

.modal-overlay.showing .modal-body {
  transform: translateY(0);
  /* Modal slides into its natural position when opened */
}

.modal-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid #e5e5e5;
  align-items: baseline;
  padding-bottom: 20px;
}

.modal-head span {
  cursor: pointer;
  padding: 5px;
  display: inline-block;
  padding-bottom: 15px;
  font-size: 20px;
}


.modal-head h5 {
  margin: 0;
  color: #333;
  font-size: 1.25rem;
}

.model-head span:hover {
  color: #888;
}

.modal-main-content {
  flex: 1;
  padding: 20px 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;
}

.modal-foot {
  display: flex;
  justify-content: space-evenly;
  padding-top: 20px;
  border-top: 1px solid #e5e5e5;
  padding-top: 15px;
}

.delete-btn,
.close-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

.delete-btn {
  background-color: #d9534f;
  color: white;
}

.close-btn {
  background-color: #f0f0f0;
  color: #333;
}

.delete-btn:hover {
  background-color: #c9302c;
}

.close-btn:hover {
  background-color: #e0e0e0;
}

.modal-head span:hover {
  color: #d9534f;
}
</style>
