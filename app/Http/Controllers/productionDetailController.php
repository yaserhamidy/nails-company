<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\row_material;
use App\Models\production_detail;

class ProductionDetailController extends Controller
{
    public function show(Request $request)
    {
        $query = $request->input('query');

        $production_details = production_detail::leftJoin('products', 'products.product_id', '=', 'production_details.product_id')
            ->leftJoin('row_materials', 'row_materials.row_material_id', '=', 'production_details.row_material_id')
            ->when($query, function ($q) use ($query) {
                return $q->where('production_details.date', 'like', '%' . $query . '%')
                         ->orWhere('products.product_name', 'like', '%' . $query . '%')
                         ->orWhere('row_materials.row_material_name', 'like', '%' . $query . '%');
            })
            ->select('production_details.*', 
                     'products.product_name as product_name', 
                     'row_materials.row_material_name as row_material_name')
            ->get();

        return view('dashboards.admins.production_detail.production_detail-show', compact('production_details'));
    }

    public function add()
    { 
        $products = Product::all(); 
        $row_materials = row_material::all(); 
        
        return view('dashboards.admins.production_detail.production_detail-add', compact('products', 'row_materials'));
    }

    public function addProduction_detail(Request $request)
    {
        $product_id = $request->product_id;
        $row_material_id = $request->row_material_id;
        $quantity_used = $request->quantity_used;
        $date = $request->date;

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($product_id);
            $product_stock = $product->stock;

            $total_quantity_used = $quantity_used * $product_stock;

            $row_material = row_material::findOrFail($row_material_id);
            
            if ($row_material->stock < $total_quantity_used) {
                return redirect()->back()->withErrors(['error' => 'محصولات اولیه کمتر موجود است ']);
            }

            $production_detail = new production_detail();
            $production_detail->product_id = $product_id;
            $production_detail->quantity_used = $total_quantity_used;
            $production_detail->row_material_id = $row_material_id;
            $production_detail->date = $date;
            $production_detail->save();

            $row_material->stock -= $total_quantity_used;
            $row_material->save();

            DB::commit();

            return redirect()->route('production_detail-show')->with('status', 'Production detail added successfully!!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Failed to add production detail: ' . $e->getMessage()]);
        }
    }

    public function production_detailEdit($production_detail_id)
    {
        $production_detail = production_detail::findOrFail($production_detail_id);
        $products = Product::all();
        $row_materials = row_material::all();

        return view('dashboards.admins.production_detail.production_detail-edit', compact('production_detail', 'products', 'row_materials'));
    }

    public function EditProduction_detail(Request $request, $production_detail_id)
    {
        $request->validate([
            'product_id' => 'required',
            'row_material_id' => 'required',
            'quantity_used' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $product_id = $request->product_id;
        $row_material_id = $request->row_material_id;
        $quantity_used = $request->quantity_used;
        $date = $request->date;

        DB::beginTransaction();

        try {
            $production_detail = production_detail::findOrFail($production_detail_id);
            $old_row_material_id = $production_detail->row_material_id;
            $old_quantity_used = $production_detail->quantity_used;

            // Calculate total quantities
            $product = Product::findOrFail($product_id);
            $product_stock = $product->stock;
            $total_quantity_used = $quantity_used * $product_stock;

            // Check if changing row materials
            if ($old_row_material_id != $row_material_id) {
                $new_row_material = row_material::findOrFail($row_material_id);
                
                // Check if new row material has enough stock
                if ($new_row_material->stock < $total_quantity_used) {
                    return redirect()->back()->withErrors(['error' => 'محصولات اولیه کمتر موجود است ']);
                }

                // Update stock for the new row material
                $new_row_material->stock -= $total_quantity_used;
                $new_row_material->save();

                // Restore stock for the old row material
                $old_row_material = row_material::findOrFail($old_row_material_id);
                $old_row_material->stock += $old_quantity_used; // Restore the old used quantity
                $old_row_material->save();
            } else {
                // If the row material hasn't changed, just update the stock
                $row_material = row_material::findOrFail($row_material_id);
                $row_material->stock = $row_material->stock + $old_quantity_used - $total_quantity_used;
                $row_material->save();
            }

            // Update production detail
            $production_detail->product_id = $product_id;
            $production_detail->quantity_used = $total_quantity_used;
            $production_detail->row_material_id = $row_material_id;
            $production_detail->date = $date;
            $production_detail->save();

            DB::commit();

            return redirect()->route('production_detail-show')->with('status', 'Production detail updated successfully!!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Failed to update production detail: ' . $e->getMessage()]);
        }
    }

    public function production_detailDelete($production_detail_id) {
        $production_detail = production_detail::find($production_detail_id);

        if ($production_detail) {
            $production_detail->delete();
            return redirect()->route('production_detail-show')->with('success', 'Production detail deleted successfully.');
        } else {
            return redirect()->route('production_detail-show')->with('error', 'Production detail not found.');
        }
    }
}


