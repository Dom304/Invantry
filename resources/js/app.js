import './bootstrap';
import { createApp } from 'vue';
import BootstrapVue3 from 'bootstrap-vue-3';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css';

import ExampleComponent from './components/ExampleComponent.vue';
import LoginComponent from './components/Login.vue';
import Homepage from './components/Homepage.vue';
import AdminLeftWindowComponent from './components/adminLeftWindow.vue';
import AdminStoresWindow from './components/AdminStoresWindow.vue';
import AdminUsersWindow from './components/AdminUsersWindow.vue';
import UserTable from './components/UserTable.vue';
import StoreTable from './components/StoreTable.vue';

// Other imports, if there are any.

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});

    // Use BootstrapVue3 globally
    app.use(BootstrapVue3);

    // Register the components globally.
    app.component('example-component', ExampleComponent);
    app.component('login-component', LoginComponent);
    app.component('homepage-component', Homepage);
    app.component('admin-left-window', AdminLeftWindowComponent);
    app.component('admin-stores-window', AdminStoresWindow);
    app.component('admin-users-window', AdminUsersWindow);
    app.component('user-table', UserTable);
    app.component('store-table', StoreTable);

    // Other global component registrations, if there are any.

    app.mount('#app'); // This element should be present in the HTML file.
});


