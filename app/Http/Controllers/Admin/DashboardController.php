<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Category;
use App\District;
use App\City;
use App\Makeup;
use App\Order;
use App\Address;
use Nexmo\Laravel\Facade\Nexmo;

class DashboardController extends Controller
{
    function aboutUs(){
            return view('about_us');
    }
 function howToOrder(){
            return view('how_to_order');
    }

    function registered(){
    	$data = User::all();

    	return view('admin.registered',['data'=>$data]);
    }

    function userdelete(Request $req){
    	$user = User::find($req->id);

    	$user->delete();
    	return redirect('registered');
    }

     function useredit($id){
    	$user = User::find($id);

    	return view('admin.useredit',['user'=>$user]);
    }

    function submitform(Request $req){
        $data = User::find($req->id);

        $data->name = $req->name;
        $data->email = $req->email;
        $data->usertype = $req->usertype;

        $data->save();

        return redirect('registered')->with('status','Updated Successfully !! ');
    }

    function makeupcategory(){

        $category = Category::all();
        return view('admin.makeupcategory',['category'=>$category]);
    }

    function submitcategory(Request $req){
        $category = new Category();

        $category->category = $req->category;
        $category->save();

        return redirect('makeupcategory')->with('success','Cosmetic Category Created !!');
    }

    function categorydelete($id){
        $category = Category::find($id);

        $category->delete();

        return redirect('makeupcategory')->with('success','Cosmetic Category Deleted !!');
    }

    function district(){

        $district = District::all();
        return view('admin.district',['district'=>$district]);
    }
    function addDistrict(Request $req){
        $district = new District();

        $district->name = $req->name;
        $district->save();

        return redirect('district')->with('success','District Created !!');
    }
    function districtDelete($id){
        $district = District::find($id);

        $district->delete();

        return redirect('district')->with('success','District Deleted !!');
    }

    function city(){

        $city = City::all();
        $district = District::all();
        return view('admin.city',['city'=>$city,'district'=>$district]);
    }

    function addCity(Request $req){
        $city = new City();

        $city->name = $req->name;
        $city->district_id = $req->district_id;
        $city->save();

        return redirect('city')->with('success','city Created !!');
    }

    function cityDelete($id){
        $city = City::find($id);

        $city->delete();

        return redirect('city')->with('success','city Deleted !!');
    }

    function makeupmenu(){

        $makeups = Makeup::all();

        return view('admin.makeupmenu',['makeups'=>$makeups]);
    }


    function addmakeup(){
        $category = Category::all();

        return view('admin.addmakeup',['cat'=>$category]);
    }

    function submitaddmakeup(Request $req){

        $makeup = new Makeup();

        $makeup->category = $req->category;
        $makeup->makeup_name = $req->name;
        $makeup->description = $req->description;

        if ($req->hasfile('image')) {
            $file = $req->file('image');
            $originalName = $file->getClientOriginalName();
            $filename = time().'.'.$originalName;
            $file->move('uploads/',$filename);
            $makeup->image = $filename;
        }

        $makeup->price = $req->price;

        $makeup->save();

        return redirect('makeupmenu')->with('success','Cosmetic Added Successfully!');;
    }

    function makeupedit(Request $req){
        $makeup = Makeup::find($req->id);
        $cat = Category::all();

        return view('admin.makeupedit',['makeup'=>$makeup, 'cat'=>$cat]);


    }
    function makeupdelete($id){
        $makeup = Makeup::find($id);
        if($makeup->image){
        unlink(public_path().'/uploads/'.$makeup->image);
        }
        $makeup->delete();

        return redirect('makeupmenu')->with('success','Cosmetic Deleted Successfully!');
    }


    function submiteditmakeup(Request $req){
        $makeup = Makeup::find($req->id);
        $makeup->category = $req->category;
        $makeup->makeup_name = $req->name;
        $makeup->description = $req->description;


        if ($req->hasfile('image')) {
            // if($makeup->image){
            // unlink(public_path().'/uploads/'.$makeup->image);
            // }
            $file = $req->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/',$filename);
            $makeup->image = $filename;
        }

        $makeup->price = $req->price;

        $makeup->save();

        return redirect('makeupmenu')->with('success','Cosmetic Updated Successfully!');

    }

    function orders(){
        $orders = DB::table('orders')
        ->join('users','orders.u_id','users.id')

        ->select(
            'orders.*',
            'users.*',
            'orders.id as order_id')->paginate(10);
        return view('admin.orders',['orders'=>$orders]);
    }

    function search(Request $req){
        $value = $req->search;
        $searches = DB::table('orders')
        ->join('users','orders.u_id','users.id')
        ->select(
            'orders.*',
            'users.*',
            'orders.id as order_id')
        ->where('order_status','like','%'.$value.'%')->paginate(10);
        return view('admin.orders',['orders'=>$searches]);
    }


    function vieworders($id){
        $user = Order::where('id',$id)->first()->u_id;
        $address = Address::where('u_id',$user)->first();

        $orders = DB::table('orders')
        ->join('makeups','orders.f_id','makeups.id')
        ->join('users','orders.u_id','users.id')
        ->select(
            'orders.*',
            'makeups.*',
            'users.*',
            'orders.id as order_id')
        ->where('orders.id',$id)
        ->get();

        return view('admin.view-order-details',['orders'=>$orders,'address' => $address]);
    }

    function updateorder(Request $req){
        $order = Order::find($req->id);
        $order->order_status = $req->os;
        $order->save();
        $user_phone = User::where([['id',$order->u_id]])->first()->phone;
        $sms = Nexmo::message()->send([
            'to'   => $user_phone,
            'from' => '9779814678481',
            'text' => ($req->os == 1) ? 'Your order is confirmed' : (($req->os == 2) ? 'Your ordered cosmetic is picked up, be patient!' : 'Your Order is delivered!, Thank you for your order!'),
        ]);
        if($sms){
            return redirect('orders')->with('success','We notified to the customer through SMS');
        }

        return redirect('orders')->with('success','order status saved and sms sent to the customer');

    }
    function dashboard(){
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

    return view('admin.dashboard',compact('data'));

    }
}
