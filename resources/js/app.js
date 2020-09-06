require('./bootstrap');
import Vue from 'vue'
import App from './App.vue'
import Customer from './CustomerApp.vue'
import AddCustomer from './AddCustomer.vue'

Vue.component('customerapp',Customer)
Vue.component('app',App)
Vue.component('addcustomer',AddCustomer)

new Vue({
  el: '#mother',
  // render: h => h(App)
})
