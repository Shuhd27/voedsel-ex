<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {

        if ($request && $request->has('category') && $request->input('category') !== '') {
            // If a category is provided, call the stored procedure with the category name
            $validated = $request->validate([
                'category' => 'required|string|max:100|in:Nothing,AGF,KV,ZPE,BB,FSKT,PRW,SSKO,SKCC,BVH',
            ]);
            $categoryName = $request->input('category');
            try {
                if($categoryName === 'Nothing') {
                    // If the category is "nothing", return all products
                    $products = DB::select('CALL sp_read_voorraad()');
                }else{

                    $products = DB::select('CALL sp_read_voorraad_by_catogory(?)', [$categoryName]);
                }
            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                Log::error('Error retrieving warehouse data by category: ' . $e->getMessage());
                $products = [];
            }
        } else {
            try {
                // Call the stored procedure to retrieve the warehouse data
                $products = DB::select('CALL sp_read_voorraad()');
            } catch (\Exception $e) {
                // Handle any exceptions that may occur
                Log::error('Error retrieving warehouse data: ' . $e->getMessage());
                $products = [];
            }
        }

        // Logic to retrieve and display the list of warehouses
        return view('warehouse.index', ['products' => $products]);
    }
    
    public function show($id)
    {
        try {
            // Call the stored procedure to retrieve the warehouse data by product ID
            $product = DB::select('CALL sp_read_voorraad_by_id(?)', [$id]);
            if (empty($product)) {
                return redirect()->route('warehouse.index')->with('error', 'Product not found.');
            }
            return view('warehouse.show', ['product' => $product[0]]);
        } catch (\Exception $e) {
            Log::error('Error retrieving product data: ' . $e->getMessage());
            return redirect()->route('warehouse.index')->with('error', 'Er is iets fout gegaan bij het ophalen van de data, probeer het later opnieuw.');
        }
    }

    public function edit($id)
    {
        try {
            // Call the stored procedure to retrieve the warehouse data by product ID
            $product = DB::select('CALL sp_read_voorraad_by_id(?)', [$id]);
            if (empty($product)) {
                return redirect()->route('warehouse.index')->with('error', 'Product not found.');
            }
            return view('warehouse.edit', ['product' => $product[0]]);
        } catch (\Exception $e) {
            Log::error('Error retrieving product data for edit: ' . $e->getMessage());
            return redirect()->route('warehouse.index')->with('error', 'Er is iets fout gegaan bij het ophalen van de data, probeer het later opnieuw.');
        }
    }

    public function update(Request $request, $id)
    {
        $maxQuantity = DB::table('warehouses')
            ->join('product_per_warehouses', 'warehouses.id', '=', 'product_per_warehouses.warehouse_id')
            ->where('product_id', $id)
            ->value('quantity');

        // Validate the request data
        $validated = $request->validate([
            'delivery_date' => 'required|date|after:today',
            'quantity' => "required|integer|min:0|max:$maxQuantity",
            'location' => 'nullable|string|max:255|in:Berlicum,Rosmalen,Sint-MichelsGestel,Middelrode,Schijndel,Gemonde,Den Bosch,Heeswijk Dinther,Vught',
        ]);

        try {
            // Update the product in the database
            DB::update('CALL sp_update_voorraad(?, ?, ?, ?)', [
                $id,
                $validated['location'],
                $validated['delivery_date'],
                $validated['quantity']
            ]);
            return redirect()->route('warehouse.show', ['id' => $id])->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating product data: ' . $e->getMessage());
            return redirect()->route('warehouse.edit', ['id' => $id])->withErrors(['error' => 'Er is iets fout gegaan bij het bijwerken van de gegevens, probeer het later opnieuw.']);
        }
    }


}
