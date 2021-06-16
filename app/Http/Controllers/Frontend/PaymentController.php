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

class PaymentController extends Controller
{
    public function PaymentOrder(Request $request){

        $total_amount = round(Cart::total() + 10000);
        
        \Stripe\Stripe::setApiKey('sk_test_51J2dybJf01AF4cNlIxWe0qlg5D9UrHukqT7ZKOlbI7VQ6KLtyjonT9wQb90xUfjNKhIuuLivixuKPPRoV7bzT4MZ00cQtpDYzY');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total_amount,
        'currency' => 'usd',
        'description' => 'B-Mart Online Shop',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);
        
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Stripe',
            'payment_method' => 'Stripe',
            'payment_type' => $charge->payment_method,
            'transaction_id' => $charge->balance_transaction,
            'currency' => 'IDR',
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'BMOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),	 
        ]);

        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
            'city' => $invoice->city,
            'province' => $invoice->province,
            'post_code' => $invoice->post_code,
            'notes' => $invoice->notes,
            'status' => 'Pending',
        ];
        
        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->to('/')->with($notification);

    }

    public function CashOrder(Request $request){

        $total_amount = round(Cart::total() + 10000);
        
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Cash on Delivery',
            'payment_method' => 'Cash on Delivery',
            'currency' => 'IDR',
            'amount' => $total_amount,

            'invoice_no' => 'BMOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),	 
        ]);

        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
            'city' => $invoice->city,
            'province' => $invoice->province,
            'post_code' => $invoice->post_code,
            'notes' => $invoice->notes,
            'status' => 'Pending',
        ];
        
        Mail::to($request->email)->send(new OrderMail($data));

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->to('/')->with($notification);


    }


}
