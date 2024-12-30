<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\dailyTask;

class productController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->input('query');
    
        $products = product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')
            ->when($query, function ($q) use ($query) {
                return $q->where('products.product_name', 'like', '%' . $query . '%')
                         ->orWhere('categories.name', 'like', '%' . $query . '%');
            })
            ->select('products.*', 'categories.name as category_name')
            ->get();
    
        return view('dashboards.admins.product.product-show', compact('products'));
    }
    public function add(){ 
        $category = category::all(); 
        
        return view('dashboards.admins.Product.product-add', compact('category'));
    }
    public function addProduct(Request $request){
  
    
        $product_name = $request->product_name;
        $description = $request->description;
        $price = $request->price;
        $unit = $request->unit;
        $stock = $request->stock;
        $cat_id = $request->cat_id;
        
    
        
        $product = new product();
        $product->product_name = $product_name;
        $product->description = $description;
        $product->price = $price;
        $product->unit = $unit;
        $product->stock = $stock;
        $product->cat_id = $cat_id;
    
        $product->save();

        return redirect()->route('product-show')->with('status' , 'product Added Successfully!!');
       
    }
    public function productDelete($product_id){
        $product = product::find($product_id);
        $product->delete();
         return redirect()->route('product-show');
    } 
    public function productEdit($product_id)
{
    $catagory = category::all();
    $product = product::find($product_id);

    // Check if the product exists
    if (!$product) {
        return redirect()->route('product-show')->with('error', 'product not found.');
    }

    return view('dashboards.admins.product.product-edit', compact('product', 'catagory'));
}
    
    public function editProduct(Request $request){
    $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|integer',
        'unit' => 'nullable',
        'stock' => 'nullable|integer',
        'cat_id' => 'required|integer',
    ]);

    $product = product::find($request->product_id);

    // Check if the product exists
    if (!$product) {
        return redirect()->route('product-show')->with('error', 'product not found.');
    }

    $product->product_name = $request->product_name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->unit = $request->unit;
    $product->stock = $request->stock;
    $product->cat_id = $request->cat_id;

    $product->save();
    
    return redirect()->route('product-show')->with('status', 'product Edited Successfully!');
}

public function addStockproduct(Request $request, $product_id)
{
    $request->validate([
        'stock' => 'required|integer|min:1',
    ]);

    $product = product::find($product_id);

    if (!$product) {
        return redirect()->route('product-show')->with('error', 'Product not found.');
    }

    // Add the stock
    $product->stock += $request->stock;
    $product->save();

    return redirect()->route('product-show')->with('status', 'Stock added successfully!');
}
}