<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    public function getOrder($id){
    	return DB::select("select *,orders.id as 'inv_id',date(orders.updated_at) as 'inv_date' from orders,customers where orders.id='$id' and orders.customer_id=customers.id");
    }
}
