<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;

class CartController extends Controller
{

    public function AddMiniCart(){

    	$carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal),

    	));
    } 

    public function RemoveMiniCart($rowId){
    	Cart::remove($rowId);
    	return response()->json(['success' => 'Product Remove from Cart']);

    }

    public function MyCart(){
        return view('frontend.cart.view_mycart');

    }

    public function GetCartProduct(){
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => round($cartTotal),

    	));

    }

    public function RemoveCart($rowId){
        Cart::remove($rowId);
    	return response()->json(['success' => 'Successfully Remove Product from Cart']);

    }

    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        return response()->json('increment');

    }

    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        return response()->json('Decrement');

    }

    public function TotalCalculation(){
        return response()->json(array(
            'total' => Cart::total(),
        )); 
    }

    public function CreateCheckout(){

        if (Auth::check()) {
            if (Cart::total() > 0) {
                
                $carts = Cart::content();
    	        $cartQty = Cart::count();
    	        $cartTotal = Cart::total();

                return view('frontend.cart.checkout_view',compact('carts','cartQty','cartTotal'));


            }else{

                $notification = array(
                    'message' => 'Your Cart is Empty',
                    'alert-type' => 'error'
                );
        
                return redirect()->to('/')->with($notification);
            }

        }else{

            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );
    
            return redirect()->route('login')->with($notification);
    
        }

    }

    public function CheckoutStore(Request $request){
        
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['province'] = $request->province;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

        if ($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }else{
            return view('frontend.payment.cash',compact('data','cartTotal'));;
        }
    }

}
