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

        $diet = $validated['dietary_preference'] ?? null;

        try {
            if (empty($diet)) {
                $families = DB::select('CALL sp_read_PeopleFamilies()');
            } else {
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
            // Gebruik jouw stored procedure om 1 family op te halen op basis van id
            $family = DB::select('CALL sp_read_family_by_id(?)', [$id]);

            if (empty($family)) {
                return redirect()->route('family.index')->with('error', 'Gezin niet gevonden.');
            }

            // $family is een array, pak het eerste element
            return view('family.show', ['family' => $family[0], 'food_packages' => $family]);
        } catch (\Exception $e) {
            Log::error('Error retrieving family data: ' . $e->getMessage());
            return redirect()->route('family.index')->with('error', 'Er is iets fout gegaan bij het ophalen van de data, probeer het later opnieuw.');
        }
    }

    public function edit($id)
    {
        try {
            // Zelfde procedure als show(), maar nu voor de edit view
            $family = DB::select('CALL sp_read_family_by_id(?)', [$id]);

            if (empty($family)) {
                return redirect()->route('family.index')->with('error', 'Gezin niet gevonden.');
            }

            return view('family.edit', ['family' => $family[0]]);
        } catch (\Exception $e) {
            Log::error('Error retrieving family data for edit: ' . $e->getMessage());
            return redirect()->route('family.index')->with('error', 'Er is iets fout gegaan bij het ophalen van de data, probeer het later opnieuw.');
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Uitgereikt,Niet Uitgereikt',
        ]);

        $familystatusResult = DB::select('SELECT status FROM food_packages WHERE family_id = ?', [$id]);
        if (!empty($familystatusResult)) {
            foreach ($familystatusResult as $result) {
                if ($result->status === 'NietMeerIngeschreven') {
                    return redirect()->route('family.show', $id)->with('error', 'Dit gezin is niet meer ingeschreven en kan daarom niet worden aangepast.');
                }
            }
        }

        try {
            // Map the status to database ENUM values
            $dbStatus = $validated['status'] === 'Uitgereikt' ? 'Uitgereikt' : 'NietUitgereikt';

            // Set distribution date if status is "Uitgereikt"
            if ($validated['status'] === 'Uitgereikt') {
                $datum = now()->format('Y-m-d');
            } else {
                $datum = null;
            }

            DB::select('CALL sp_update_Family(?, ?, ?)', [$id, $dbStatus, $datum]);

            return redirect()->route('family.show', $id)
                ->with('success', 'De wijziging is doorgevoerd');
        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
            return back()->withErrors('Er is iets fout gegaan bij het wijzigen van de status.');
        }
    }
}
