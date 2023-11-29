<template>
  <div :class="{ 'modal-overlay': true, 'showing': show }">
    <div class="modal-body">
      <div class="modal-head">
        <h5>Edit User Details</h5>
        <span aria-hidden="true" @click="close">&times;</span>
      </div>

      <div class="modal-main-content">
        <form @submit.prevent="editUser">
          <div class="form-group">
            <label for="username">Name</label>
            <input type="text" id="username" v-model="updateInfo.name" class="form-input">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="updateInfo.email" class="form-input">
          </div>

          <div class="form-group">
            <label for="role">Role</label>
            <select id="role" v-model="updateInfo.role" class="form-select">
              <option value="admin">Admin</option>
              <option value="moderator">Moderator</option>
              <option value="buyer">Buyer</option>
              <option value="manager">Manager</option>
            </select>
          </div>

          <div class="modal-foot">
            <button type="submit" class="submit-btn">Save Changes</button>
            <button @click="close" class="cancel-btn">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  name: 'edit-modal',
  emits: ['close', 'updated-successfully'],
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

    async editUser() {

      axios.put(`/user/${this.updateInfo.id}`, {
        name: this.updateInfo.name,
        email: this.updateInfo.email,
        role: this.updateInfo.role,
      })
        .then(response => {
          this.$emit('updated-successfully');
          this.close();
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
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  transform: translateY(-100%);
  transition: transform 0.3s ease-out;
}

.modal-overlay.showing .modal-body {
  transform: translateY(0);
}

.modal-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
}

.modal-head h5 {
  margin: 0;
  color: #333;
  font-size: 1.25rem;
}

.modal-head span {
  cursor: pointer;
  padding: 5px;
}

.modal-head span:hover {
  color: #f44336;
}

.modal-main-content {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

.form-input,
.form-select {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  margin-top: 5px;
}

.modal-foot {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.submit-btn,
.cancel-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

.submit-btn {
  background-color: #d9534f;
  /* Red color for Save Changes button */
  color: white;
}

.cancel-btn {
  background-color: #f0f0f0;
  /* Light grey for Cancel button */
  color: #333;
}

.submit-btn:hover {
  background-color: #c9302c;
  /* Darker red on hover for Save Changes */
}

.cancel-btn:hover {
  background-color: #e0e0e0;
  /* Lighter grey on hover for Cancel */
}</style>
