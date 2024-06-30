// import 'bootstrap/dist/css/bootstrap.min.css';
// import { createApp } from 'vue'
// import App from './App.vue'

// createApp(App).mount('#app')
import 'bootstrap/dist/css/bootstrap.min.css';
import { createApp } from 'vue';
import App from './App.vue';
import store from './store';

createApp(App).use(store).mount('#app');
