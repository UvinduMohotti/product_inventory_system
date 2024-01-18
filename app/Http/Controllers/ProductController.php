<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class ProductController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|',
                'description' => 'required|',
                'quantity_in_stock' => 'required|int',
                'price' => 'required',
                'category_id' => 'required|int'
            ]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
            return $this->sendError("Validation Error", $errors);
        }

        $name = $request->input("name");
        $description = $request->input("description");
        $quantity_in_stock = $request->input("quantity_in_stock");
        $price = $request->input("price");
        $category_id = $request->input("category_id");

        $category = Category::find($category_id);
        if (!$category) {
            return $this->sendResponse(null, "Category not Found!");
        }

        $product = new Product();
        $product->name = $name;
        $product->description = $description;
        $product->quantity_in_stock = $quantity_in_stock;
        $product->price = $price;
        $product->category_id = $category_id;
        $product->save();
        return $this->sendResponse($product, "Product Added Successfully!");
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function search(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            return $this->sendResponse($product, "Product Data retrieved Successfully!");
        } else {
            return $this->sendResponse(null, "Product not Found!");
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return $this->sendResponse(null, "Product Deleted Successfully!");
        } else {
            return $this->sendResponse($product, "Product not Found!");
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function findAll(Request $request)
    {
        $products = Product::with("category")->get();
        return $this->sendResponse($products, "Product Data retrieved Successfully!");
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|',
                'description' => 'required|',
                'price' => 'required',
                'category_id' => 'required|int'
            ]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
            return $this->sendError("Validation Error", $errors);
        }

        $name = $request->input("name");
        $description = $request->input("description");
        $price = $request->input("price");
        $category_id = $request->input("category_id");

        $category = Category::find($category_id);

        if (!$category) {
            return $this->sendResponse(null, "Category not Found!");
        }

        $product = Product::find($id);
        if (!$product) {
            return $this->sendResponse(null, "Product not Found!");
        }
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $category_id;
        $product->save();
        return $this->sendResponse($product, "Product Updated Successfully!");
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateQuantity(Request $request, $id)
    {
        try {
            $request->validate([
                'updated_quantity_in_stock' => 'required|int'
            ]);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
            return $this->sendError("Validation Error", $errors);
        }


        $updated_quantity_in_stock = $request->input("updated_quantity_in_stock");

        $product = Product::find($id);

        if (!$product) {
            return $this->sendResponse(null, "Product not Found!");
        }

        $product->quantity_in_stock = $updated_quantity_in_stock;
        $product->save();

        return $this->sendResponse($product, "Product Quantity Updated Successfully!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function findAllCategory(Request $request){
        $categories=Category::all();
        return $this->sendResponse($categories, "Categories retrieved Successfully!");
    }


}
