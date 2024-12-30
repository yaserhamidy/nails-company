<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\row_material;
class rowMaterialController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->input('query');
    
        $row_materials = row_material::leftJoin('categories', 'categories.cat_id', '=', 'row_materials.cat_id')
            ->when($query, function ($q) use ($query) {
                return $q->where('row_materials.row_material_name', 'like', '%' . $query . '%')
                         ->orWhere('categories.name', 'like', '%' . $query . '%');
            })
            ->select('row_materials.*', 'categories.name as category_name')
            ->get();
    
        return view('dashboards.admins.row_material.row_material-show', compact('row_materials'));
    }
    public function add(){ 
        $category = category::all(); 
        
        return view('dashboards.admins.row_material.row_material-add', compact('category'));
    }
    public function addRow_material(Request $request){
  
    
        $row_material_name = $request->row_material_name;
        $description = $request->description;
        $price = $request->price;
        $unit = $request->unit;
        $stock = $request->stock;
        $cat_id = $request->cat_id;
        
    
        
        $row_material = new row_material();
        $row_material->row_material_name = $row_material_name;
        $row_material->description = $description;
        $row_material->price = $price;
        $row_material->unit = $unit;
        $row_material->stock = $stock;
        $row_material->cat_id = $cat_id;
        
        $row_material->save();
        
        return redirect()->route('row_materail-show')->with('status' , 'row_material Added Successfully!!');
       
    }   
    public function row_materialDelete($row_material_id) {
        $row_material = row_material::find($row_material_id);
    
        if ($row_material) {
            $row_material->delete();
            return redirect()->route('row_materail-show')->with('success', 'Row material deleted successfully.');
        } else {
            return redirect()->route('row_materail-show')->with('error', 'Row material not found.');
        }
    }
    public function row_materialEdit($row_material_id)
{
    $catagory = category::all();
    $row_material = row_material::find($row_material_id);

    // Check if the row_material exists
    if (!$row_material) {
        return redirect()->route('row_material-show')->with('error', 'row_material not found.');
    }

    return view('dashboards.admins.row_material.row_material-edit', compact('row_material', 'catagory'));
}
    
    public function editrow_material(Request $request){
    $request->validate([
        'row_material_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'nullable|integer',
        'unit' => 'nullable',
        'stock' => 'nullable|integer',
        'cat_id' => 'required|integer',
    ]);

    $row_material = row_material::find($request->row_material_id);

    // Check if the row_material exists
    if (!$row_material) {
        return redirect()->route('row_material-show')->with('error', 'row_material not found.');
    }

    $row_material->row_material_name = $request->row_material_name;
    $row_material->description = $request->description;
    $row_material->price = $request->price;
    $row_material->unit = $request->unit;
    $row_material->stock = $request->stock;
    $row_material->cat_id = $request->cat_id;

    $row_material->save();
    
    return redirect()->route('row_materail-show')->with('status', 'row_material Edited Successfully!');
}

public function addStock(Request $request, $row_material_id)
{
    $request->validate([
        'stock' => 'required|integer|min:1',
    ]);

    $row_material = row_material::find($row_material_id);

    if (!$row_material) {
        return redirect()->route('row_materail-show')->with('error', 'Row material not found.');
    }

    // Add the stock
    $row_material->stock += $request->stock;
    $row_material->save();

    return redirect()->route('row_materail-show')->with('status', 'Stock added successfully!');
}
}
