import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import LoginComponent from './components/Login.vue';
import Homepage from './components/Homepage.vue'; // path to Homepage.vue
import adminLeftWindowComponent from './components/adminLeftWindow.vue';
import AdminStoresWindow from './components/AdminStoresWindow.vue';
import AdminUsersWindow from './components/AdminUsersWindow.vue';
// import { AdminDashboardEventBus } from './AdminDashboardEventBus.js';

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});

    // Register the components globally.
    app.component('example-component', ExampleComponent);
    app.component('login', LoginComponent);
    app.component('homepage', Homepage);
    app.component('admin-left-window', adminLeftWindowComponent);
    app.component('admin-stores-window', AdminStoresWindow);
    app.component('admin-users-window', AdminUsersWindow);

    app.mount('#app'); // This element should be present in the HTML file.
});

