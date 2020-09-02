require('./bootstrap');
import Vue from 'vue'
import App from './App.vue'
import Customer from './CustomerApp.vue'

Vue.component('customerapp',Customer)
Vue.component('app',App)

new Vue({
  el: '#mother',
  // render: h => h(App)
})
