<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;

class customerController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->get('query');
    
        // If a query is provided, filter the categories
        if ($query) {
            $customers = customer::where('customer_name', 'LIKE', "%{$query}%")->get();
        } else {
            // If no query, get all categories
            $customers = customer::all();
        }
    
        return view('dashboards.admins.customer.customer-show', compact('customers'));
    }
    public function add(){  
        return view('dashboards.admins.customer.customer-add');
    }
    public function addCustomer(Request $request){
        $request->validate([
            'customer_name' => 'required|string|min:3|max:255',
            'phone' => 'nullable|string|max:10', // Adjust max length as needed
            'address' => 'nullable|string|max:500', // Adjust max length as needed
        ]);
    
        $customer_name = $request->customer_name;
        $phone = $request->phone;
        $address = $request->address;
        
    
        $customer = new customer();
        
        $customer->customer_name = $customer_name;
        $customer->phone = $phone;
        $customer->address = $address;
      
    
        $customer->save();
        
        return redirect()->route('customer-show')->with('status' , 'customer Added Successfully!!');
       
    }
    public function customerDelete($customer_id)
    {
        $customer = customer::find($customer_id);
    
        if (!$customer) {
            return redirect()->route('customer-show')->with('error', 'Customer not found.');
        }
    
        $customer->delete();
        return redirect()->route('customer-show')->with('success', 'Customer deleted successfully.');
    }
public function customerEdit($customer_id){
    $customer = customer::find($customer_id);
    return view('dashboards.admins.customer.customer-edit', compact('customer'));


}

    
public function editCustomer(Request $request){
    $customer_name = $request->customer_name;
    $phone = $request->phone;
    $address = $request->address;

    $customer = customer::find($request->customer_id);
        $customer->customer_name = $customer_name;
        $customer->phone = $phone;
        $customer->address = $address;
      
    
    $customer->save();
    
    // $catagories = catagory::all();
    // return view('admin.catagory.show_catagory', compact('catagories'));
    return redirect()->route('customer-show')->with('status' , 'customer Edited Successfully!!');

}

   
}
