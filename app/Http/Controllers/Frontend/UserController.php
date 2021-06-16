<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class UserController extends Controller
{
    
    public function MyOrder(){

        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.profile.order_view',compact('orders'));

    }

    public function OrderDetails($order_id){

    	$order = Order::where('id',$order_id)->where('user_id',Auth::id())->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('frontend.profile.order_details',compact('order','orderItem'));

    }


}
