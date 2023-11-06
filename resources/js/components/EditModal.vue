<template>
    <div :class="{ 'modal-overlay': true, 'showing': show }">
      <div class="modal-body">
        <div class="model-head">
          <h5>Edit User Details</h5>
          <span aria-hidden="true" @click="close">&times;</span>
        </div>
        <div class="model-main-content">
          <form @submit.prevent="editUser">
            <label for="username">Name</label>
            <input type="text" id="username" v-model="updateInfo.name">
  
            <label for="email">Email</label>
            <input type="email" id="email" v-model="updateInfo.email">

            <label for="role">Role</label>
            <select id="role" v-model="updateInfo.role">
                <option value="admin">Admin</option>
                <option value="moderator">Moderator</option>
                <option value="buyer">Buyer</option>
                <option value="manager">Manager</option>
            </select>
  
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
  
export default {
  name: 'edit-modal',
  props: {
    show: {
      type: Boolean,
      default: false
    },
    userData: {
      type: Object,
      default: () => ({})
    }
  },
  data() {
    return {
      updateInfo: { ...this.userData }
    };
  },
  watch: {
    userData: {
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

    editUser() {
  console.log(this.updateInfo.id);
  axios.put(`/user/${this.updateInfo.id}`, {
      name: this.updateInfo.name,
      email: this.updateInfo.email,
      role: this.updateInfo.role,
  })
  .then(response => {
    this.$emit('update-user', this.updateInfo); // Emit an event when user is updated
    this.close(); // Close the modal
  })
  .catch(error => {
    console.error("There was an error updating the user:", error);
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