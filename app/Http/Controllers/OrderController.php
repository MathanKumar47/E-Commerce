<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function manage_order(){
        $orders = Order::all();
        return view('dashboards.admin.order.manage_order',compact('orders'));
    }

    public function view_order($id){
        $orders = Order::where('id',$id)->first();
        $order_by_id = OrderDetail::where('order_id',$id)->get();
        return view('dashboards.admin.order.view_order',compact('orders','order_by_id'));
    }
}
