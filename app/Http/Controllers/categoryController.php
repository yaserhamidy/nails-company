<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class categoryController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->get('query');
    
        // If a query is provided, filter the categories
        if ($query) {
            $catagories = Category::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            // If no query, get all categories
            $catagories = Category::all();
        }
    
        return view('dashboards.admins.category.category-show', compact('catagories'));
    }
    public function add(){  
        return view('dashboards.admins.category.category-add');
    }
    public function addCategory(Request $request){
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000', // Adjust max length as needed
        ]);
    
        $name = $request->name;
        $description = $request->description;
        
    
        $catagory = new category();
        
        $catagory->name = $name;
        $catagory->description = $description;
    
        $catagory->save();
        
        return redirect()->route('category-show')->with('status' , 'category Added Successfully!!');
       
    }


    public function categoryDelete($cat_id){
        $catagory = category::find($cat_id);
        $catagory->delete();
         return redirect()->route('category-show');
} 


public function categoryEdit($cat_id){
    $catagory = category::find($cat_id);
    return view('dashboards.admins.category.category-edit', compact('catagory'));


}

    
public function editCategory(Request $request){
    $name = $request->name;
    $description = $request->description;
    

    $catagory = category::find($request->cat_id);
    $catagory->name = $name;
    $catagory->description = $description;

    $catagory->save();
    
    // $catagories = catagory::all();
    // return view('admin.catagory.show_catagory', compact('catagories'));
    return redirect()->route('category-show')->with('status' , 'category Edited Successfully!!');

}

}
