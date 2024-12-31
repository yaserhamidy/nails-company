<?php

namespace App\Http\Controllers;
use App\Models\order;
use App\Models\customer;
use App\Models\Product;
use App\Models\Sale; // Add this line
use Illuminate\Http\Request;

class orderController extends Controller
{
       public function show(Request $request)
    {
        $query = $request->input('query');

        $orders = Order::leftJoin('products', 'products.product_id', '=', 'orders.product_id')
            ->leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->when($query, function ($q) use ($query) {
                return $q->where('orders.order_date', 'like', '%' . $query . '%') // Correct field name
                         ->orWhere('products.product_name', 'like', '%' . $query . '%')
                         ->orWhere('customers.customer_name', 'like', '%' . $query . '%');
            })
            ->select('orders.*', 
                     'products.product_name as product_name', 
                     'customers.customer_name as customer_name')
            ->get();

        return view('dashboards.admins.order.order-show', compact('orders'));
    }

    public function add()
    { 
        $products = Product::all(); 
        $customers = Customer::all(); 
        
        return view('dashboards.admins.order.order-add', compact('products', 'customers'));
    }
  
    public function addOrder(Request $request)
    {
        $request->validate([
            
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'status' => 'in:Continued,Finished',
            'order_date' => 'required|date',
        ]);
    
        // Check if there is enough stock
        $product = Product::find($request->product_id);
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock for this product.');
        }
    
        // Reduce stock of the product before saving the order
  
        $product->save();
    
        // Create the order
        $order = new Order();
        $order->product_id = $request->product_id;
        $order->customer_id = $request->customer_id; 
        $order->quantity = $request->quantity; 
        $order->unit_price = $request->unit_price; 
        $order->total_price = $request->total_price; 
        $order->status = $request->status ?: 'Continued';
        $order->order_date = $request->order_date; 
    
        $order->save();
    
        return redirect()->route('order-show')->with('status', 'Order Added Successfully!!');
    }

    public function updateStatus($order_id)
    {
        $order = Order::find($order_id);
        
        if (!$order) {
            return redirect()->route('order-show')->with('error', 'Order not found.');
        }
        
        $product = Product::find($order->product_id);
    
        if ($order->status === 'Finished') {
            // If it's already finished, handle cancellation
            $sale = Sale::where('product_id', $order->product_id)
                ->where('customer_id', $order->customer_id)
                ->where('sale_date', '>=', now()->startOfDay())
                ->first();
    
            if ($sale) {
                // Remove the sale record
                $sale->delete();
                // Restore the stock
                if ($product) {
                    $product->stock += $order->quantity; // Restore stock
                    $product->save();
                }
                $order->status = 'Continued';
                $order->save();
                return redirect()->route('order-show')->with('status', 'Sale canceled and order restored.');
            }
        } else {
            // Check if there is enough stock before marking the order finished
            if ($product && $product->stock >= $order->quantity) {
                // Mark it as finished and create a sale
                $sale = new Sale();
                $sale->product_id = $order->product_id;
                $sale->customer_id = $order->customer_id;
                $sale->quantity = $order->quantity;
                $sale->unit_price = $order->unit_price;
                $sale->total_price = $order->total_price;
                $sale->sale_date = now();
                $sale->status = 'Completed'; // Set sale status
                $sale->save();
    
                // Reduce stock of the product
                $product->stock -= $order->quantity; // Ensure stock is reduced only once
                $product->save();
    
                // Optionally, delete the order if necessary
                $order->delete();
                return redirect()->route('order-show')->with('status', 'Order marked as finished and sale created.');
            } else {
                return redirect()->route('order-show')->with('error', 'Not enough stock to complete the order.');
            }
        }
    
        return redirect()->route('order-show')->with('status', 'Order status updated successfully!');
    }
    

    public function orderEdit($order_id)
    {
        $order = Order::findOrFail($order_id);
        $products = Product::all();
        $customers = Customer::all();

        return view('dashboards.admins.order.order-edit', compact('order', 'products', 'customers'));
    }

    public function updateOrder(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);

        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'customer_id' => 'required|exists:customers,customer_id',
            'quantity' => 'required|integer',
            'unit_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'status' => 'in:Continued,Finished',
            'order_date' => 'required|date',
        ]);

        // Update the order
        $order->product_id = $request->product_id;
        $order->customer_id = $request->customer_id; 
        $order->quantity = $request->quantity; 
        $order->unit_price = $request->unit_price; 
        $order->total_price = $request->total_price; 
        $order->status = $request->status ?: 'Continued';
        $order->order_date = $request->order_date; 

        $order->save();

        return redirect()->route('order-show')->with('status', 'Order updated successfully!');
    }

}
