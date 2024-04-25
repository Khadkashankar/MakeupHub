<?php

namespace App;
use App\Makeup;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['u_id','f_id','order_no','order_status','quantity','shipping_charge','total_price','order_note','payment_method','payment_status'];


    public function makeup(){
        return $this->belongsTo(Makeup::class,'f_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'u_id');
    }
}
