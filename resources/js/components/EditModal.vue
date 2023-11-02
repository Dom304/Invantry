<template>
    <div :class="{ 'modal-overlay': true, 'showing': show }">
      <div class="modal-body">
        <div class="model-head">
          <h5>Edit User Details</h5>
          <span aria-hidden="true" @click="close">&times;</span>
        </div>
        <div class="model-main-content">
          <form @submit.prevent="updateUser">
            <label for="username">Name</label>
            <input type="text" id="username" v-model="user.username">
  
            <label for="email">Email</label>
            <input type="email" id="email" v-model="user.email">

            <label for="role">Role</label>
            <select id="role" v-model="user.role">
                <option value="admin">Admin</option>
                <option value="moderator">Moderator</option>
                <option value="user">User</option>
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
    props: {
      show: {
        type: Boolean,
        default: false
      },
      userData: { // Assume you are passing the user data as a prop
        type: Object,
        default: () => ({})
      }
    },
    data() {
      return {
        user: this.userData
      };
    },
    methods: {
      close() {
        this.$emit('close');
      },
      updateUser() {
        // Call your API or Vuex action to update the user details here.
        // For the sake of this example, we're just emitting an event.
        this.$emit('update-user', this.user);
        this.close();
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
    }

    .model-foot {
        display: flex;
        justify-content: space-between;
        padding-top: 20px;
        border-top: 1px solid #e5e5e5;
    }
</style>