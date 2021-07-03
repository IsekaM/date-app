import './bootstrap';
import Vue from 'vue';

//Main pages
import App from './views/App.vue';

const files = require.context('./components/', true, /\.vue$/i);
files.keys().map(key => {
  Vue.component(key.split('/').pop().split('.')[0], files(key).default);
});

window.Bus = new Vue();

const app = new Vue({
  el: '#date-app',
  components: { App }
});
