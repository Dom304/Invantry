import './bootstrap';

import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import LoginComponent from './components/Login.vue';

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    app.component('example-component', ExampleComponent);
    app.component('login', LoginComponent);
    app.mount('#app');
});