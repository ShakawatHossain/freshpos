<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
	 public function savecustomer(Request $req){

    	$customer = new Customer();
    	$customer->code = $req->customer['code'];
    	$customer->email = $req->customer['email'];
    	$customer->name = $req->customer['name'];
    	$customer->city = $req->customer['city'];
    	$customer->phone = $req->customer['phone'];
    	$customer->country = $req->customer['country'];
    	$customer->address = $req->customer['address'];
    	$customer->type = $req->customer['type'];
    	// $order->customer_id = $req->order['customer']['id'];
    	// $order->order_details = serialize($req->order['lineItems']);
    	// $order->total = $req->order['grandTotal'];
    	// $order->status = $req->order['status'];
    	$customer->save();
    	return response()->json(["id"=>$customer->id]);
    }
    public function index(){
    	return view('customer');
    }
    
    public function getCustomer(){
    	$customer = new Customer();
    	return $customer->getCustomerList();
    }

    public function getCustomerList(){
    	$customer = new Customer();
    	return json_encode($customer->getCustomerList());
    }
}
