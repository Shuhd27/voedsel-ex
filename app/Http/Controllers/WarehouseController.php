<?php

namespace App\Http\Controllers;


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
}
