<template>
  <div :class="{ 'modal-overlay': true, 'showing': show }">
    <div class="modal-body">
      <div class="modal-head">
        <h5>Deletion</h5>
        <span aria-hidden="true" @click="close">&times;</span>
      </div>
      <div class="modal-main-content">
        Are you sure you want to delete {{ username }}?
      </div>
      <div class="modal-foot">
        <button @click="deleteUser">Continue</button>
        <button @click="close">Close</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: false
    },
    userId: {
      type: Number,
    },
    username: { // Adding username as a prop
      type: String,
      default: ''
    }
  },
  methods: {
    close() {
      this.$emit('close');
    },
    deleteUser() {
      axios.delete(`/user/${this.userId}`)
        .then(response => {
          console.log("User deleted successfully"); // Use console.log instead of console.success
          this.$emit('user-deleted-successfully'); // Emit an event when user is deleted
          this.close(); // Close the modal
        })
        .catch(error => {
          // Handle the error. Maybe show a notification to the user.
          console.error("There was an error deleting the user:", error);
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
  opacity: 0; /* Initially set the overlay to be invisible */
  pointer-events: none; /* Ensure it doesn't block anything when not shown */
  transition: opacity 0.3s; /* Transition effect for fade-in */
}

.modal-overlay.showing {
  opacity: 1;
  pointer-events: auto; /* Restore pointer events when modal is shown */
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
  transform: translateY(-100%); /* Starts off the screen */
  transition: transform 0.3s ease-out; /* Transition effect for sliding in */
}

.modal-overlay.showing .modal-body {
  transform: translateY(0); /* Modal slides into its natural position when opened */
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
  flex: 1;
  padding: 20px 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.model-foot {
  display: flex;
  justify-content: space-between;
  padding-top: 20px;
  border-top: 1px solid #e5e5e5;
}
</style>