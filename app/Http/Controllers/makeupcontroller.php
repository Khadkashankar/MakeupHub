<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Makeup;
use Cart;
use App\Address;
use App\District;
use App\City;
use App\Order;
use App\Artist;
use App\User;
use App\Rating;
use App\Recommendation;
use App\Feedback;
use Illuminate\Support\Str;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class makeupcontroller extends Controller
{
    public function index(){
    	// $makeups = Makeup::paginate(12);
        // ........................ makeup menu recommendation .....................
        $total_makeup_menu = Makeup::all();

        $artists = Artist::with('user')->get();

        if($total_makeup_menu->count() > 0){
        $menuId = [];

        foreach ($total_makeup_menu as $key => $menu) {
            $menuId[]= $menu->id;
        }
        $k = array_rand($menuId);
        $makeup_menu_id = $menuId[$k];

        $rating = DB::table('rating')
        ->join('makeups','rating.m_id','=','makeups.id')
        ->join('users','rating.u_id','=','users.id')
        ->where('makeups.id','=',$makeup_menu_id);

        $sum = $rating->sum('rating_value');
        $count = count($rating->get());

        if($count == 0){
            $count = 1;
        }
         $mean = ceil($sum/$count);

         $rec = Recommendation::updateOrCreate([
            'ma_id'=>$makeup_menu_id,
         ],
         ['mean_rating'=>$mean,]
     );
         $rec->save();

         $recommend_ma = DB::table('recommendation')
            ->join('makeups','recommendation.ma_id','=','makeups.id')
            ->where('mean_rating','>',2)
            ->orderByRaw("RAND()")
            ->limit(7)
            ->get();
        $recommend_ma1 = DB::table('recommendation')
            ->join('makeups','recommendation.ma_id','=','makeups.id')
            ->where('mean_rating','>',2)
            ->orderByRaw("RAND()")
            ->limit(7)
            ->get();

        $recommend_both = DB::table('recommendation')
            ->join('makeups','recommendation.ma_id','=','makeups.id')
            ->where('mean_rating','>',2)
            ->orderByRaw("RAND()")
            ->limit(7)
            ->get();
        return view('index',['makeups'=>$total_makeup_menu,'artists' => $artists,'recommendation_ma'=>$recommend_ma,'recommendation_ma1'=>$recommend_ma1,'recommendation_both'=>$recommend_both]);
        }else{
        	dd('Something Went Wrong ! Please visit later');
        }


    }


    // ...........................end of index blade page function .............................

    public function makeup_details($id){

        if(Auth::user()){
            $data['rating_value'] = Rating::all()
            ->where('u_id',Auth::User()->id)
            ->where('m_id',$id);
        }
        $data['total_rating'] = Rating::where('m_id',$id)->count();
        $data['details'] = Makeup::find($id);
        return view('makeup-details',['data'=>$data]);
    }

    public function rating(Request $req){
        $rating = Rating::updateOrCreate([
            'u_id'=>Auth::User()->id,
            'm_id'=>$req->fid,
        ],
        ['rating_value'=>$req->ratingval]
    );
        $rating->save();

        return redirect()->back()->withErrors(['Thanks for rating!']);
    }

// add items to cart.....

    function cart($id){
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->with('error', 'You need to be logged in to add items to the cart.');
        }

        $makeup = Makeup::where([['id',$id]])->first();

        Cart::add(['id' => $makeup->id,'name' => $makeup->makeup_name,'qty'=> '1','price' => $makeup->price,'weight' => '1','options' => ['image' => $makeup->image,'description' => $makeup->description]]);

        DB::table('carts')->insert([
            'user_id' => $user->id,
            'makeup_id' => $makeup->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
            return redirect('/cart')->with('success', 'Cosmetic has been added into your cart');
    }


    function  carthandler(){
        $cart_items = Cart::content();
    	return view('cart',['carts'=>$cart_items]);
    }


    function orders(){
        $orders = Order::where([['u_id',auth()->user()->id],['order_status','!=','3']])->orderBy('created_at','desc')->get();

         $recentorder = DB::table('orders')
        ->join('makeups','orders.mu_id','=','makeups.id')
        ->join('users','orders.u_id','=','users.id')
        ->where('users.id',Auth::User()->id)
        ->where('orders.order_status','3')
        ->orderBy('orders.created_at','desc')->get();

        $rsum = DB::table('orders')
        ->join('makeups','orders.mu_id','=','makeups.id')
        ->join('users','orders.u_id','=','users.id')
        ->where('users.id',Auth::User()->id)
        ->where('orders.order_status','3')
        ->sum('total_price');
    	return view('myorders',['orders'=>$orders,'recentorder'=>$recentorder,'rtotal'=>$rsum]);
    }


    function removecart($id){
        $removecart = Cart::remove($id);
        $total_price = Cart::subtotal();
        return response($total_price);
    }

    function updatecart(Request $req){
        Cart::update($req->id,$req->qty);
        $total_price = Cart::subtotal();
        return response($total_price);
    }

    function checkout(){
        $data = [];
        $data['district'] = District::all();
        $data['city'] = City::all();
        $data['cart_content'] = Cart::content();
        $data['address'] = Address::where('u_id',auth()->user()->id)->first();
        return view('checkout',compact('data'));
    }

    function getCity(Request $request){
        $city = City::where([['district_id',$request->id]])->get();
        return $city;
    }


    function ordermakeup(Request $req){
      $data['address'] = Address::where('u_id',auth()->user()->id)->first();

      if(!$data['address']){
        $req->validate([
            'district' =>'required',
            'city'=>'required',
            'street_address'=>'required',
            'phone'=>'required'
        ]);

        $address = new Address();
        $address->u_id = Auth::User()->id;
        $address->district_id = $req->district;
        $address->street_address = $req->street_address;
        $address->city_id = $req->city;
        $address->phone = $req->phone;
        $address->email = $req->email;
        $address->save();

    }

        $carts = Cart::content();

        foreach($carts as $cart){
            $order = Order::create([
                'u_id' => auth()->user()->id,
                'mu_id' => $cart->id,
                'order_no' => random_int(000000, 999999),
                'order_status' => '0',
                'quantity' => $cart->qty,
                'shipping_charge' => '50',
                'total_price' => $cart->price * $cart->qty,
                'order_note' => $req->order_note,
                'payment_method' => $req->payment,
                'payment_status' => '0',
            ]);
            }

            if($order){
                Session::pull('cart');
                return redirect('myorders')->with('success','Thank you for ordering makeup, We will delivered as soon as possible! Thank You !');
            }else{
                return 'failed';
        }
    }

    function editAddress(Request $req){
        $address = Address::where('u_id',auth()->user()->id)->update([
            'district_id' => $req->district,
            'city_id' => $req->city,
            'street_address' => $req->street_address,
            'phone' => $req->phone,
            'email' => $req->email,
        ]);

        if($address){
            return redirect('/checkout')->with('success','Address has been updated !');
        }
        else{
            return redirect('/checkout')->with('error','Address updation failed!');
        }
    }


    function invoice(Request $req){
        $orders = Order::where([['u_id',auth()->user()->id],['order_status','!=','3']])->get();

       $pdf = PDF::loadview('invoice', compact('orders'));
       return $pdf->download('yourorder.pdf');
    }




    function order_details(){
        $address = Address::where('u_id',auth()->user()->id)->first();
        $order_details = Order::where([['u_id',auth()->user()->id],['order_status','!=','3']])->orderBy('created_at','desc')->get();

        return view('order-details',['order_details'=>$order_details,'address' => $address]);
    }

    function cancel_order($id){

        Order::find($id)->delete();

        return redirect('myorders');
    }


    function search(Request $req){
        $value = $req->search;

        $search_makeup = DB::table('makeups')
                    ->where('makeup_name','like','%'.$value.'%')
                    ->paginate(20);

        $search_count_makeup = count($search_makeup);

        $search_artist = DB::table('artists')
                    ->join('users', 'artists.u_id', '=', 'users.id')
                    ->where('users.usertype', 'artist')
                    ->where('users.name', 'like', '%' . $value . '%')
                    ->paginate(20);

         $search_count_artist = count($search_artist);

        return view('search',[
            'makeupsearch'=>$search_makeup,
            'value'=>$value,
            'makeupcount'=>$search_count_makeup,
            'artistsearch'=>$search_artist,
            'artistcount'=>$search_count_artist
        ]);
    }


    function profile(){
        $user = User::all()
        ->where('id',Auth::User()->id);
        return view('profile',['user'=>$user]);
    }



    function feedback(Request $req){
        $feedback = new Feedback();
        $feedback->email = $req->email;
        $feedback->subject = $req->subject;
        $feedback->feedback = $req->feedback;

        $feedback->save();
        return redirect('/')->with('success','Thank You For your feedback !!');
    }




    function all(){
        $dateS = Carbon::now()->subMonth(6);
        $dateE = Carbon::now();
        $all = Rating::whereBetween('created_at',[$dateS,$dateE])->get();
        return view('rating',['all'=>$all]);

    }
}
