<template>
    <div class="image-container">
        <img :src="'/images/Button_backpack_logo.png'" alt="Invantry Logo" class="mx-auto d-block centered-image">
        <div class="app-login-in-name">Invantry</div>
        <div class="description">PERSONAL BELONGINGS MANAGEMENT SYSTEM</div>
        <div class="create-acc">CREATE YOUR ACCOUNT</div>
        <div id="signup-form">

            <div class="input-container">
                <label for="nameField" class="input-label">Name</label>
                <input type="text" id="nameField" class="username-input" placeholder="Name" name="name" v-model="name">
            </div>

            <div class="input-container">
                <label for="emailField" class="input-label">Email</label>
                <input type="email" id="emailField" class="password-input" placeholder="Email" name="email" v-model="email">
            </div>

            <div class="input-container">
                <label for="passwordField" class="input-label">Password</label>
                <div class="password-container">
                    <input :type="passwordFieldType" id="passwordField" ref="passwordField" class="password-input" placeholder="Password" v-model="password">
                    <span @click="togglePassword" class="password-icon" :class="{ active: isPasswordVisible }">
                        <img :src="eyeIcon" alt="Toggle Password Visibility">
                    </span>
                </div>
            </div>

            <button class="action-btn continue-btn" @click="signUp">Continue</button>
        </div>
        <div class="log-in">ALREADY HAVE AN ACCOUNT? <a href="/" class="log-in-link">LOG IN</a></div>
    </div>
    <Toast />
</template>

<script>
import axios from 'axios';
import Toast from 'primevue/toast';

export default {
    name: 'SignUp',
    components: {
        Toast,
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            passwordFieldType: 'password',
            isPasswordVisible: false,
            showToast: false,
        };
    },
    computed: {
        eyeIcon() {
            return this.isPasswordVisible ? '/images/eye-open.png' : '/images/eye-closed.png';
        }
    },
    methods: {
        togglePassword() {
            if (this.passwordFieldType === 'password') {
                this.passwordFieldType = 'text';
                this.isPasswordVisible = true;
            } else {
                this.passwordFieldType = 'password';
                this.isPasswordVisible = false;
            }
        },

        signUp() {
            const userData = {
                name: this.name,
                email: this.email,
                password: this.password,
            };

            axios.post('/signUp', userData)
                .then(response => {
                    this.resetForm();
                    this.$toast.add({severity:'success', summary: 'Success', detail: response.data.message, life: 60000});
                })
                .catch(error => {
                    console.error(error);
                    this.$toast.add({severity:'error', summary: 'Error', detail: response.data.message, life: 60000});
                });
        },

        resetForm() {
            this.name = '';
            this.email = '';
            this.password = '';
        }
    }
};
</script>
