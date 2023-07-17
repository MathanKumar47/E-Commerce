<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $quantity = $request->quantity;
        $id = $request->id;

        $products = DB::table('products')
             ->where('id',$id)
             ->first();

        $product = Product::where('id', $id)->first();
        $data['quantity'] = $quantity;
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['attributes'] = [$product->image];

        Cart::add($data);
        cartArray();
        return redirect()->back();
    }
    
    public function delete($id){
        Cart::remove($id);
        return redirect()->back();
    }
}
