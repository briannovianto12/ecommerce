<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
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

    	$order = Order::with('user')->where('id',$order_id)->where('user_id',Auth::id())->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('frontend.profile.order_details',compact('order','orderItem'));

    }

    public function ReviewProduct(Request $request){

        $product = $request->product_id;
        $request->validate([

            'comment' => 'required',
        ]);
        
        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'summary' => $request->summary,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        
		$notification = array(
            'message' => 'Product Review Successfully Submited',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);

    }

    public function ReviewView(){

        $review = Review::where('status',0)->orderBy('id','DESC')->get();
        return view('backend.review.review_view',compact('review'));

    }


}
