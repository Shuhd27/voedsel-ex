<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FamilyController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'dietary_preference' => 'nullable|string|max:100|in:GeenVarken,Veganistisch,Vegetarisch,Omnivoor',
        ]);

        $diet = $request->input('dietary_preference');

        try {
            if (empty($diet)) {
                // No filter - get all families
                $families = DB::select('CALL sp_read_PeopleFamilies()');
            } else {
                // Filter by dietary preference
                $diet = $request->input('dietary_preference', '');
                $families = DB::select('CALL sp_read_families_by_dietary_preference(?)', [$diet]);
            }
        } catch (\Exception $e) {
            Log::error('Error retrieving family data: ' . $e->getMessage());
            $families = [];
        }

        return view('family.index', compact('families'));
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
}
