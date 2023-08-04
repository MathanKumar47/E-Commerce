<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Whistlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $product_id = $request->input('product_id');

            $prod_check = Product::where('id',$product_id)->first();

            if ($prod_check){

                if (Whistlist::where('product_id',$product_id)->where('user_id',$user_id)->exists()){
                    return response()->json(['status' => "Already in Wishlist"]);
                }else{
                    Whistlist::create([
                        'user_id' => $user_id,
                        'product_id' => $product_id,
                    ]);
        
                    return response()->json(['status' => "Added to Wishlist"]);
                }
            }
            
        } else {
            // Handle case when the user is not authenticated.
            // You might want to redirect them to the login page or display an error message.
            return response()->json(['status' => "First Login"]);
        }
    }

    public function cartcount()
    {
        $wishlistCount = Whistlist::where('user_id', Auth::id())->count();

        return response()->json(['wishlistCount' => $wishlistCount]);
    }


    public function removeFromWishlist(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $product_id = $request->input('product_id');

            Whistlist::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->delete();

            return back()->with(['status' => "Product removed from wishlist"]);
        } else {
            return back()->with(['status' => "Please login to remove items from wishlist"]);
        }
    }
}
