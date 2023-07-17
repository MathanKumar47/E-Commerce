<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboards.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('dashboards.admin.product.create', compact('categories', 'subcategories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->cat_id = $request->category;
        $product->subcat_id = $request->subcategory;
        $product->br_id = $request->brand;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $images = array();
        if ($files = $request->file('file')) {
            $i = 0;
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $fileNameExtract = explode('.', $name);
                $fileName = $fileNameExtract[0];
                $fileName .= time();
                $fileName .= $i;
                $fileName .= '.';
                $fileName .= $fileNameExtract[1];
                $file->move('image', $fileName);
                $images[] = $fileName;
                $i++;
            }
            $product['image'] = implode("|", $images);
            $product->save();
            return redirect()->back()->with('message', 'Product Added Successfully');
        } else {
            echo "error";
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Product $product)
    {
        if ($product->status == 1) {
            $product->update(['status' => 0]);
        } else {
            $product->update(['status' => 1]);
        }
        return redirect()->back()->with('message', 'Status Change Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('dashboards.admin.product.edit', compact('product', 'categories', 'subcategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Product $product)
    {
        $product->code = $request->code;
        $product->name = $request->name;
        $product->cat_id = $request->category;
        $product->subcat_id = $request->subcategory;
        $product->br_id = $request->brand;
        $product->description = $request->description;
        $product->price = $request->price;

        $images = array();
        if ($files = $request->file('file')) {
            $i = 0;
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $fileNameExtract = explode('.', $name);
                $fileName = $fileNameExtract[0];
                $fileName .= time();
                $fileName .= $i;
                $fileName .= '.';
                $fileName .= $fileNameExtract[1];
                $file->move('image', $fileName);
                $images[] = $fileName;
                $i++;
            }
            $product->image = implode("|", $images);
        }

        $product->save();

        return redirect('/products')->with('message', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $delete = $product->delete();
        if ($delete) {
            return redirect()->back()->with('message', 'Product Deleted Successfully');
        }
    }
}
