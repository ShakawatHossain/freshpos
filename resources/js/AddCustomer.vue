<template>
  <div>
    <table class="table">
      <tr v-if="customer.type=='Regular customer'">
        <td>Code:</td>
        <td><input type="text" name="code" v-model="customer.code" ></td>
        <td>Email:</td>
        <td><input type="email" name="email" v-model="customer.email" ></td>
      </tr>
      <tr>
        <td>Name:</td>
        <td><input type="text" name="code" v-model="customer.name"></td>
        <td v-if="customer.type=='Regular customer'">City</td>
        <td><input type="text" name="city" v-model="customer.city" v-if="customer.type=='Regular customer'"></td>
      </tr>
      <tr v-if="customer.type=='Regular customer'">
        <td>Phone:</td>
        <td><input type="text" name="phone" v-model="customer.phone"></td>
        <td>Country</td>
        <td><input type="text" name="country"  v-model="customer.country"></td>
      </tr>
      <tr>
        <td v-if="customer.type=='Regular customer'">Address:</td>
        <td v-if="customer.type=='Regular customer'"><input type="text" name="address"  v-model="customer.address"></td>
        <td>Type</td>
        <td><v-select class="form-control" label="Customer Type"  v-model="customer.type" :options="ctype"/></td>
      </tr>
      <tr>
        <td colspan="4"><button class="btn btn-primary float-right" v-on:click="creatCustomer()" data-dismiss="modal">SUBMIT</button></td>
      </tr>
    </table>
  </div>
</template>

<script>
import {bus} from "./app";
  export default {
    
    data () {
      return {
        ctype: ["WalkInCustomer","Regular customer"],
        customer: {
          id: 0,
          code: "",
          email: "",
          name: "",
          city: "",
          phone: "",
          country: "",
          address: "",
          type: "WalkInCustomer"
        }
      }
    },
    methods: {
      creatCustomer: function(){
        axios.post('savecustomer', {
                    customer: this.customer
                  })
                  .then(response => {
                    var resp = JSON.stringify(response.data.id);
                    this.customer.id = resp;
                    // console.log(resp);
                    // window.location.href = 'order/printinvoice?id='+resp;
                    // window.location.href = 'pos';
                    bus.$emit('newcustomer',this.customer);
                  })
                  .catch(e => {
                    console.log(e);
                  })
      },
    }
  }
</script>

