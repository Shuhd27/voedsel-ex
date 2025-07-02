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
                // Geen filter: haal alle families op
                $families = DB::select('CALL sp_read_PeopleFamilies()');
            } else {
                // dd($diet);
                // Filteren op eetwens
                $families = DB::select('CALL sp_read_families_by_dietary_preference(?)', [$diet]);
            }
        } catch (\Exception $e) {
            Log::error('Fout bij ophalen van gegevens: ' . $e->getMessage());
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
            // Haal het gezin op via de stored procedure
            $family = DB::select('CALL sp_read_family_by_id(?)', [$id]);

            if (empty($family)) {
                return redirect()->route('family.index')
                    ->with('error', 'Gezin niet gevonden.');
            }



            // Toon de bewerkpagina
            return view('family.edit', ['family' => $family[0]]);
        } catch (\Exception $e) {
            Log::error('Error retrieving family data for edit: ' . $e->getMessage());

            return redirect()->route('family.index')
                ->with('error', 'Er is iets fout gegaan bij het ophalen van de data, probeer het later opnieuw.');
        }
    }

    public function update(Request $request, $id)
    {
        // Valideer de input
        $validated = $request->validate([
            'status' => 'required|in:Uitgereikt,Niet Uitgereikt',
        ]);

        // Controleer of het gezin nog ingeschreven is
        $statusResult = DB::table('food_packages')
            ->where('family_id', $id)
            ->pluck('status');

        if ($statusResult->contains('NietMeerIngeschreven')) {
            return redirect()->route('family.edit', $id)
                ->with('error', 'Dit gezin is niet meer ingeschreven bij de voedselbank en daarom kan er geen voedselpakket worden uitgereikt.');
        }

        // Zet de status om naar de database ENUM waarde
        $dbStatus = $validated['status'] === 'Uitgereikt' ? 'Uitgereikt' : 'NietUitgereikt';

        // Alleen bij 'Uitgereikt' zetten we de distributiedatum
        $distributionDate = $validated['status'] === 'Uitgereikt' ? now()->format('Y-m-d') : null;

        try {
            // Roep de stored procedure aan om status bij te werken
            DB::statement('CALL sp_update_food_package_status(?, ?, ?)', [
                $id,
                $dbStatus,
                $distributionDate
            ]);

            return redirect()->route('family.edit', $id)
                ->with('success', 'De wijziging is succesvol doorgevoerd.');
        } catch (\Exception $e) {
            Log::error("Fout bij het bijwerken van de status voor gezin ID $id: " . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Er is een fout opgetreden bij het wijzigen van de status.');
        }
    }
}
