<template>
    <div class="image-container">
        <div class="logo-app-container">
            <img :src="'/images/Button_backpack_logo.png'" alt="Invantry Logo" class="mx-auto d-block centered-image">
            <div class="app-login-in-name">Invantry</div>
            <div class="description">PERSONAL BELONGINGS MANAGEMENT SYSTEM</div>
        </div>
        <div class="welcome-back">WELCOME BACK</div>

        <div class="input-container">
                <label for="emailField" class="input-label">Email</label>
                <input type="email" id="emailField" class="password-input" placeholder="Email" name="email" v-model="email">
            </div>
            
        <div id="login-form">

            <div class="input-container">
                <label for="passwordField" class="input-label">Password</label>
                <div class="password-container">
                    <input :type="passwordFieldType" id="passwordField" ref="passwordField" class="password-input" placeholder="Password" v-model="password">
                    <span @click="togglePassword" class="password-icon" :class="{ active: isPasswordVisible }">
                        <img :src="eyeIcon" alt="Toggle Password Visibility">
                    </span>
                </div>
            </div>
        </div>
        <button class="action-btn continue-btn" @click="login">Continue</button>
        <div class="log-in">DON'T HAVE AN ACCOUNT? <a href="/signUp" class="sign-up-link">SIGN UP</a></div>
        <Toast />
    </div>
    
</template>


  
<script>
import axios from 'axios';
import Toast from 'primevue/toast';

export default {
    name: 'Login',
    components: {
        Toast,
    },
    data() {
        return {
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

        login() {
            axios.post('/', {
                email: this.email,
                password: this.password
            })
            .then(response => {
                if (response.data.success) {
                    window.location.href = response.data.redirect;
                } else {
                    console.error("Login failed");
                    this.$toast.add({
                        severity: 'error',
                        summary: 'Error',
                        detail: response.data.message || 'Login failed. Please try again.',
                        life: 60000
                    });
                }
            })
            .catch(error => {
                console.error(error);
                let errorMessage = error.response && error.response.data && error.response.data.message
                                ? error.response.data.message
                                : "An unknown error occurred";
                this.$toast.add({
                    severity: 'error',
                    summary: 'Error',
                    detail: errorMessage,
                    life: 60000
                });
            });
        }




    },
};
</script>
