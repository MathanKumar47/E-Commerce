<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        $products = Product::where('status', 1)->latest()->limit(20)->get();

        $top_sales = DB::table('products')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.id, SUM(order_details.product_sales_quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->take(8)
            ->get();
        $topProducts = [];
        foreach ($top_sales as $s) {
            $p = Product::findOrFail($s->id);
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }
        return view('frontend.welcome', compact('categories', 'subcategories', 'brands', 'products','topProducts'));
    }
}
