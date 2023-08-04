<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('dashboards.admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboards.admin.subcategory.create',compact('categories'));
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
                'name' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $subcategory = new SubCategory;
            $subcategory->cat_id = $request->input('category');
            $subcategory->name = $request->input('name');
            $subcategory->description = $request->input('description');
            $subcategory->save();

            return response()->json(['message' => 'SubCategory Created Successfully'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create subcategory'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(SubCategory $subcategory)
    {
        try {
            $status = $subcategory->status == 1 ? 0 : 1;
            $subcategory->update(['status' => $status]);

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
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('dashboards.admin.subcategory.edit',compact('categories','subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            }

            $subCategory->name = $request->input('name');
            $subCategory->cat_id = $request->input('category');
            $subCategory->description = $request->input('description');
            $subCategory->save();

            return response()->json(['message' => 'SubCategory Updated Successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update subcategory'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $delete = $subCategory->delete();
            if ($delete) {
                return response()->json(['message' => 'SubCategory Deleted Successfully'], Response::HTTP_OK);
            } else {
                return response()->json(['error' => 'Failed to delete subcategory'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete subcategory'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
