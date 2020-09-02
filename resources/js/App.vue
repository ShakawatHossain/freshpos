<template>
  <div id="app" class="container">
    <div class="col-md-3">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th colspan=3><center>List of Customers</center></th>
          </tr>
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>phone</th>
          </tr>
        </thead>
        <tr v-for="customer in customers" v-on:click="onCustomerClick(customer)">
          <td> {{customer.code}} </td>
          <td> {{customer.name}} </td>
          <td> {{customer.phone}} </td>
        </tr>
      </table>
    </div>

    <div class="col-md-6">
      <label>Enter Item code and press enter to add product into cart</label>
      <input type="text" v-model="searchQuery" v-on:keyup.enter="search" class="form-control" placeholder="Item Code" />
      <br/>
      <div class="row">
        <div class="col-md-8"><label>Name:</label>{{ c_name }}</div>
        <div class="col-md-4"><label>Phone:</label>{{ c_phone }}</div>
      </div>
      </hr/>
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
              <th>Item Details</th>
              <th>Unit Price</th>
              <th>Quantity</th>
              <th>Line Total</th>
              <th></th>
          </tr>
        </thead>
        <tbody> 
            <tr v-for="item in lineItems">
                <td>{{ item.item.name }}</td>
                <td>{{ item.item.price }}</td>
                <td>
                    <span v-if="!item.editing" v-on:dblclick=" toggleEdit(item)" >{{ item.numberOfItems }}</span>
                    <input v-if="item.editing" v-on:blur=" toggleEdit(item)" type="number" v-model="item.numberOfItems">
                </td>
                <td>{{  item.numberOfItems * item.item.price }}</td>
                <td><i class="fa fa-times" v-on:click="removeItem(item)"></i></td>
            </tr>
        </tbody>
      </table>
      <table class="table">
        <thead style="background-color: #dbeef3;color:#424d68;">
          <tr>
            <th>Subtotal</th>
            <th>Total</th>
            <th>Vat</th>
            <th>Grand Total</th>
          </tr>
        </thead>
        <tbody style="background-color: #dbeef3;">
            <tr>                                
                <th>{{ subtotal  }}</th>
                <th>{{  total  }}</th>
                <th>{{  tax  }}</th>
                <th>{{  grandTotal  }}</th>
            </tr>
        </tbody>
        <tfoot>
          <tr>
            <th colspan=3 style="background-color: #f2f2f2;">Amount to be paid</th>
            <th>{{  grandTotal  }}</th>
          </tr>
        </tfoot>
      </table>
      <hr/>
      <button class="btn-primary float-right" v-on:click="placeorder()">Order</button>
    </div>

    <div class="col-md-3">
      <table class="table table-striped table-hover table-bordered table-responsive">
        <thead>
          <tr>
            <th colspan=3><center>List of Products</center></th>
          </tr>
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>price</th>
          </tr>
        </thead>
        <tr v-for="item in items" v-on:click="onItemClick(item)">
          <td> {{item.code}} </td>
          <td> {{item.name}} </td>
          <td> {{item.price}} </td>
        </tr>
      </table>
    </div>
    
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      customers: [],
      items: [],
      lineItems: [],
      searchQuery:null,
      c_name: "Select Customer",
      c_phone: "Select Customer",
      order: {
        customer: null,
        lineItems: [],
        grandTotal: 0
      }
    }
  },
  created: function() {          
      const requestOne = axios.get('getproductlist');
      const requestTwo = axios.get('getcustomerlist');
      requestOne.then(response => (this.items = response.data));
      requestTwo.then(response => (this.customers = response.data));
  },
  methods: {
    placeorder: function(){
      this.order.lineItems = this.lineItems;
      this.order.grandTotal = this.grandTotal;
      axios.post('order', {
                  order: this.order
                })
                .then(response => {
                  var resp = JSON.stringify(response.data.id);
                  // console.log(resp);
                  window.location.href = 'order/printinvoice?id='+resp;
                  window.location.href = 'order/printinvoice?id='+resp;
                })
                .catch(e => {
                  console.log(e);
                })
    },
    onCustomerClick: function(customer) {
      this.c_name = customer.name;
      this.c_phone = customer.phone;
      this.order.customer = customer;
    },
    onItemClick: function(item) {
      //console.log(item);
      var found = false;

      for (var i = 0; i < this.lineItems.length; i++) {
          if (this.lineItems[i].item === item) {
              this.lineItems[i].numberOfItems++;
              found = true;
              break;
          }
      }
      if (!found) {
          this.lineItems.push({ item: item, numberOfItems: 1, editing: false });
      }
    },
    toggleEdit: function(lineItem) {
        lineItem.editing = !lineItem.editing;
    },
    removeItem: function(lineItem) {
        for (var i = 0; i < this.lineItems.length; i++) {
            if (this.lineItems[i] === lineItem) {
                this.lineItems.splice(i, 1);
                break;
            }
        }
    },
    search(){
      if(this.searchQuery){
        this.items.filter((i)=>{
          if(i.code.toLowerCase() === this.searchQuery.toLowerCase()){
              this.onItemClick(i);
          }
        });
      }
    },
    roundToTwoDigitsAfterComma(floatNumber) {
      return parseFloat((Math.round(floatNumber * 100) / 100).toFixed(2));
    },

  },
  computed: {
    subtotal: function() {
      var subtotal = 0;
      this.lineItems.forEach(function(item) {
          subtotal += item.item.price * item.numberOfItems;
      });
      return this.roundToTwoDigitsAfterComma(subtotal);
    },
    tax: function() {
        return this.roundToTwoDigitsAfterComma(this.subtotal * 0.065);
    },
    total: function() {
        return this.roundToTwoDigitsAfterComma(this.subtotal);
    },
    grandTotal: function(){
        return this.roundToTwoDigitsAfterComma(this.total + this.tax);
    }
  }
}
</script>

<style>

</style>
