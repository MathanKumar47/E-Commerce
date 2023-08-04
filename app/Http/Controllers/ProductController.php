<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
        try {
            $validator = Validator::make($request->all(), [
                'category' => 'required',
                'subcategory' => 'required',
                'brand' => 'required',
                'code' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'file' => 'required|array',
                'file.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $product = new Product;
            $product->cat_id = $request->input('category');
            $product->subcat_id = $request->input('subcategory');
            $product->br_id = $request->input('brand');
            $product->code = $request->input('code');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');

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

            return response()->json(['message' => 'Product Added Successfully'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add product'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Product $product)
    {
        try {
            $status = $product->status == 1 ? 0 : 1;
            $product->update(['status' => $status]);

            return response()->json(['message' => 'Status Change Successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to change status'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required',
                'name' => 'required',
                'category' => 'required',
                'subcategory' => 'required',
                'brand' => 'required',
                'description' => 'required',
                'price' => 'required',
                'file' => 'array',
                'file.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $product->code = $request->input('code');
            $product->name = $request->input('name');
            $product->cat_id = $request->input('category');
            $product->subcat_id = $request->input('subcategory');
            $product->br_id = $request->input('brand');
            $product->description = $request->input('description');
            $product->price = $request->input('price');

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

            return response()->json(['message' => 'Product Updated Successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $delete = $product->delete();
            if ($delete) {
                return response()->json(['message' => 'Product Deleted Successfully'], Response::HTTP_OK);
            } else {
                return response()->json(['error' => 'Failed to delete product'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete product'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
