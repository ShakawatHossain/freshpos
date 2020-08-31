<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function getCustomerList(){
    	$cus = DB::select("SELECT id,code,name,phone from customers");
    	return $cus;
    }
}
