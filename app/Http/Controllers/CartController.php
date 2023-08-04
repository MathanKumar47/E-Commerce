<?php

namespace App\Http\Controllers;

use App\Models\Cart as ModelsCart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Whistlist;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $quantity = $request->input('quantity');
        $id = $request->id;

        if (Auth::check()) {
            $user_id = Auth::id(); // Get the authenticated user's ID
        } else {
            // Handle the case when the user is not logged in.
            // You can choose to redirect to a login page or handle it based on your application's requirements.
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        $product = Product::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Add the item to the cart
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'attributes' => [$product->image],
        ]);

        // Store the cart item in the database
        $cartItem = new ModelsCart();
        $cartItem->user_id = $user_id;
        $cartItem->product_id = $product->id;
        $cartItem->quantity = $quantity;
        $cartItem->save();

        return back()->with(['status' => "Product Added Cart"]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        if (Auth::check()) {
            $user_id = Auth::id(); // Get the authenticated user's ID
        } else {
            // Handle the case when the user is not logged in.
            // You can choose to redirect to a login page or handle it based on your application's requirements.
            return redirect()->route('login')->with('error', 'Please login to remove items from cart.');
        }

        // Find the cart item for the current user and product
        $cartItem = ModelsCart::where('user_id', $user_id)
            ->where('product_id', $id)
            ->first();

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }

        // Remove the item from the cart
        Cart::remove($id);

        // Delete the cart item from the database
        $cartItem->delete();

        return back()->with(['status' => "Cart Removed Successfully..."]);
    }

    public function cartCount()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $cartCount = ModelsCart::where('user_id', $user_id)->count();
            return $cartCount;
        }

        return 0; // If the user is not authenticated, return 0 items in the cart.
    }

}
