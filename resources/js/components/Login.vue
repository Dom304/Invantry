<template>
    <div class="image-container">
        <img :src="'/images/Button_backpack_logo.png'" alt="Invantry Logo" class="mx-auto d-block centered-image">
        <div class="app-name">Invantry</div>
        <div class="description">PERSONAL BELONGINGS MANAGEMENT SYSTEM</div>
        <div class="welcome-back">WELCOME BACK</div>
        <input type="text" class="username-input" placeholder="Username/Email address">
        <div class="password-container">
            <input :type="passwordFieldType" ref="passwordField" class="password-input" placeholder="Password">
            <span @click="togglePassword" class="password-icon" :class="{ active: isPasswordVisible }">
                <img :src="eyeIcon" alt="Toggle Password Visibility">
            </span>

        </div>
        <button class="action-btn continue-btn">Continue</button>
        <div class="sign-up">DON'T HAVE AN ACCOUNT? <a href="#" class="sign-up-link">SIGN UP</a></div>
    </div>
</template>
  
<script>
export default {
    name: 'Login',
    data() {
        return {
            passwordFieldType: 'password',
            isPasswordVisible: false,
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
    },
};
</script>
