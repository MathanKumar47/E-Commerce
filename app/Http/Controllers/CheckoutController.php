<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Models\Payment;
use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Foreach_;

class CheckoutController extends Controller
{
    public function index()
    {
        $customer_id = Auth::id();
        return view('frontend.pages.checkout', compact('customer_id'));
    }

    public function save_shipping_address(Request $request)
    {
        $data = $request->only(['name', 'email', 'address', 'city', 'country', 'zip_code', 'mobile']);
        $data['id'] = Auth::id();

        // Insert data into the Shipping model
        $shipping = Shipping::updateOrCreate(['id' => $data['id']], $data);
        $s_id = $shipping->id;

        // Store the shipping ID in the session
        Session::put('id', $s_id);

        // Continue with further processing or redirect as needed
        return redirect('/payment');
    }


    public function payment()
    {
        $cartCollection = Cart::getContent();
        $cart_array = $cartCollection->toArray();
        return view('frontend.pages.payment', compact('cart_array'));
    }

    public function order_place(Request $request)
    {
        $payment_method = $request->payment;

        // Insert data into the Payment model
        $payment = new Payment();
        $payment->payment_method = $payment_method;
        $payment->status = 'pending';
        $payment->save();
    

        $payment_id = $payment->getKey();

        // Insert data into the Order model
        $order = new Order();
        $order->cus_id = Auth::id();
        $order->ship_id = Session::get('id');
        $order->pay_id = $payment_id;
        $order->total = Cart::getTotal();
        $order->status = 'pending';
        $order->save();

        $order_id = $order->getKey();

        // Insert data into the order_details table
        $cartCollection = Cart::getContent();

        foreach ($cartCollection as $cartContent) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order_id;
            $orderDetail->product_id = $cartContent->id;
            $orderDetail->product_name = $cartContent->name;
            $orderDetail->product_price = $cartContent->price;
            $orderDetail->product_sales_quantity = $cartContent->quantity;
            $orderDetail->save();
        }

        if($payment_method == 'cash'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }elseif($payment_method == 'bkash'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }elseif($payment_method == 'nogod'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }elseif($payment_method == 'rocket'){
            Cart::clear();
            return view('frontend.pages.payment_method');
        }
    }
}
