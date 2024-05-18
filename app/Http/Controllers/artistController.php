<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Category;
use App\District;
use App\City;
use App\Artist;
use App\Makeup;
use App\Order;
use App\Address;
use Nexmo\Laravel\Facade\Nexmo;

class artistController extends Controller
{
    function artistDashboard(){
        $data = [];

        $data['total_order'] = Order::all()->count();
        $data['new_order'] = Order::all()
        ->where('order_status','0')
        ->count();
        $data['order_confirmed'] = Order::all()
        ->where('order_status','1')
        ->count();

        $data['makeup_pickup'] = Order::all()
        ->where('order_status','2')
        ->count();

        $data['makeup_delivered'] = Order::all()
        ->where('order_status','3')
        ->count();


        $data['total_regd_users'] = User::count();

    return view('artist.dashboard',compact('data'));

    }

}
