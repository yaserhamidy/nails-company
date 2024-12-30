<?php

namespace App\Http\Controllers;
use App\Models\Sale; // Import the Sale model
use App\Models\Product; // If you need to retrieve product names
use App\Models\Customer; // If you need to retrieve customer names
use App\Models\order; // If you need to retrieve customer names

use Illuminate\Http\Request;

class saleController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->input('query');

        // Retrieve sales data with optional search functionality
        $sales = Sale::leftJoin('products', 'products.product_id', '=', 'sales.product_id')
            ->leftJoin('customers', 'customers.customer_id', '=', 'sales.customer_id')
            ->when($query, function ($q) use ($query) {
                return $q->where('products.product_name', 'like', '%' . $query . '%')
                         ->orWhere('customers.customer_name', 'like', '%' . $query . '%');
            })
            ->select('sales.*', 
                     'products.product_name as product_name', 
                     'customers.customer_name as customer_name')
            ->get();

        return view('dashboards.admins.sale.sale-show', compact('sales'));
    }

    public function cancelSale($sale_id)
    {
        $sale = Sale::find($sale_id);
    
        if (!$sale) {
            return redirect()->route('sale-show')->with('error', 'Sale not found.');
        }
    
        // Logic to reverse the sale back to an order
        $order = new Order();
        $order->product_id = $sale->product_id;
        $order->customer_id = $sale->customer_id;
        $order->quantity = $sale->quantity;
        $order->unit_price = $sale->unit_price;
        $order->total_price = $sale->total_price;
        $order->status = 'Continued'; // Set initial status
        $order->order_date = $sale->sale_date; // Use the sale date as the order date
        $order->save();
    
        // Update the product stock
        $product = Product::find($sale->product_id);
        if ($product) {
            $product->stock += $sale->quantity; // Increase stock by the quantity sold
            $product->save();
        }
    
        // Remove the sale record
        $sale->delete();
    
        return redirect()->route('sale-show')->with('status', 'Sale canceled and order restored, stock updated.');
    }
}
