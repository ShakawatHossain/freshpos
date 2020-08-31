<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    //
    public function saveorder(Request $req){

    	$order = new Order();
    	$order->customer_id = $req->order['customer']['id'];
    	$order->order_details = serialize($req->order['lineItems']);
    	$order->total = $req->order['grandTotal'];
    	$order->save();
    	return response()->json($req->all());
    }
    public function printinvoice(){
    	return view('invoice');
    }
}
