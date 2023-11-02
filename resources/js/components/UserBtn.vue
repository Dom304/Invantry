<template>
    <div class="user-name-dropdown">
        <button class="user-name-btn" @click="toggleDropdown">
            Hi, {{ username }}
            <i class="arrow-down-icon"></i>
        </button>
        <div class="dropdown-content" v-show="isDropdownOpen">
            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <div class="logout-form">
                <form @submit.prevent="logout">
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'UserMenu',
    props: {
        username: String,
    },
    data() {
        return {
            isDropdownOpen: false,
        };
    },
    methods: {
        logout() {
            axios.get('/logout')
                .then(response => {
                    window.location.href = '/login';
                })
                .catch(error => {
                    console.error('Logout failed:', error);
                });
        },

        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
    },
};
</script>
