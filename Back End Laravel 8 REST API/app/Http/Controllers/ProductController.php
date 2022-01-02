<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Product::get();
        $response = [
            'message' => 'List Product',
            'data' => $category
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'slug' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            'regular_price' => ['required', 'numeric'],
            'sale_price' => ['required', 'numeric'],
            'SKU' => ['required'],
            'stock_status' => ['required', 'in:instock, outofstock'],
            'featured' => ['required'],
            'quantity' => ['required'],
            'image' => ['required'],
            'category_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $category = Product::create($request->all());
            $response = [
                'message' => 'Product Created',
                'data' => $category
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Product::findOrFail($id);
        $response = [
            'message' => 'Detail Product',
            'data' => $category
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $category = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'slug' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            'regular_price' => ['required', 'numeric'],
            'sale_price' => ['required', 'numeric'],
            'SKU' => ['required'],
            'stock_status' => ['required', 'in:instock, outofstock'],
            'featured' => ['required'],
            'quantity' => ['required'],
            'image' => ['required'],
            'category_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $category->update($request->all());
            $response = [
                'message' => 'Product Updated',
                'data' => $category
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Product::findOrFail($id);

        try {
            $category->delete();
            $response = [
                'message' => 'Product Deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => "Failed" . $e->errorInfo
            ]);
        }
    }
}
