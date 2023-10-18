import './bootstrap';

import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import LoginComponent from './components/Login.vue';
import Homepage from './components/Homepage.vue'; // path to Homepage.vue

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    app.component('example-component', ExampleComponent);
    app.component('login', LoginComponent);
    app.component('homepage', Homepage); // registering Homepage component
    app.mount('#app');
});
