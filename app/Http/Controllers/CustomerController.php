<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function getCustomer(){
    	$customer = new Customer();
    	return $customer->getCustomerList();
    }
}