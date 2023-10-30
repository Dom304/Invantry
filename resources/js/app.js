import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import LoginComponent from './components/Login.vue';
import Homepage from './components/Homepage.vue'; // path to Homepage.vue

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({});
    // Instead of passing an empty object to createApp, we pass the Homepage component as the root instance.
    // const app = createApp(Homepage);

    // Register the components globally.
    app.component('example-component', ExampleComponent);
    app.component('login', LoginComponent);
    app.component('homepage', Homepage); // You don't necessarily need to register the Homepage globally since it's the root component.

    app.mount('#app'); // This element should be present in the HTML file.
});
