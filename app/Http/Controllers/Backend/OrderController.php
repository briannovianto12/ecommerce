<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Auth;
use DB;
use Carbon\Carbon;


class OrderController extends Controller
{

    public function PendingOrders(){

        $orders = Order::where('status','Pending')->orderBy('id','DESC')->get();
        return view('backend.orders.pending_order',compact('orders'));

    }

    public function PendingOrderDetails($order_id){
        
        $order = Order::with('user')->where('id',$order_id)->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('backend.orders.pending_order_details',compact('order','orderItem'));


    }

    // Confirmed Orders 
	public function ConfirmedOrders(){
		$orders = Order::where('status','confirmed')->orderBy('id','DESC')->get();
		return view('backend.orders.confirmed_order',compact('orders'));
	} // end mehtod 


	// Processing Orders 
	public function ProcessingOrders(){
		$orders = Order::where('status','processing')->orderBy('id','DESC')->get();
		return view('backend.orders.processing_order',compact('orders'));

	} // end mehtod 


	// Picked Orders 
	public function PickedOrders(){
		$orders = Order::where('status','picked')->orderBy('id','DESC')->get();
		return view('backend.orders.picked_order',compact('orders'));

	} // end mehtod 



	// Shipped Orders 
	public function ShippedOrders(){
		$orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
		return view('backend.orders.shipped_order',compact('orders'));

	} // end mehtod 


	// Delivered Orders 
	public function DeliveredOrders(){
		$orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
		return view('backend.orders.delivered_order',compact('orders'));

	} // end mehtod 


	// Cancel Orders 
	public function CancelOrders(){
		$orders = Order::where('status','canceled')->orderBy('id','DESC')->get();
		return view('backend.orders.cancel_order',compact('orders'));

	} // end mehtod 

    public function PendingToConfirm($order_id){

        Order::findOrFail($order_id)->update([
            'status' => 'confirmed'
        ]);
        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('confirmed.orders')->with($notification);
    }

    public function ConfirmToProcessing($order_id){

        Order::findOrFail($order_id)->update(['status' => 'processing']);
  
        $notification = array(
              'message' => 'Order Processing Successfully',
              'alert-type' => 'success'
          );
  
          return redirect()->route('processing.orders')->with($notification);
  
  
      } // end method
  
  
    public function ProcessingToPicked($order_id){
  
        Order::findOrFail($order_id)->update(['status' => 'picked']);
  
        $notification = array(
              'message' => 'Order Picked Successfully',
              'alert-type' => 'success'
          );
  
          return redirect()->route('picked.orders')->with($notification);
  
  
      } // end method
  
  
    public function PickedToShipped($order_id){
  
        Order::findOrFail($order_id)->update(['status' => 'shipped']);
  
        $notification = array(
              'message' => 'Order Shipped Successfully',
              'alert-type' => 'success'
          );
  
          return redirect()->route('shipped.orders')->with($notification);
  
  
      } // end method
  
  
    public function ShippedToDelivered($order_id){

        $product = OrderItem::where('order_id',$order_id)->get();
        foreach ($product as $item) {
            Product::where('id',$item->product_id)
                    ->update(['product_qty' => DB::raw('product_qty-'.$item->qty)]);
        } 
  
        Order::findOrFail($order_id)->update(['status' => 'delivered']);
  
        $notification = array(
              'message' => 'Order Delivered Successfully',
              'alert-type' => 'success'
          );
  
          return redirect()->route('delivered.orders')->with($notification);
  
  
      } // end method

      public function OrderDelete($id){

        Order::findOrFail($id)->update(['status' => 'canceled']);

        $notification = array(
            'message' => 'Order Canceled Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } 
  
  
}
