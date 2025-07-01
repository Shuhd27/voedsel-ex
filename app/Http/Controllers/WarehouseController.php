<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WarehouseController extends Controller
{
    public function index()
    {

        try {
            // Call the stored procedure to retrieve the warehouse data
            $products = DB::select('CALL sp_read_voorraad()');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            Log::error('Error retrieving warehouse data: ' . $e->getMessage());
            $products = [];
        }

        // Logic to retrieve and display the list of warehouses
        return view('warehouse.index', ['products' => $products]);
    }


}
