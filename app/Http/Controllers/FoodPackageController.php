<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class FoodPackageController extends Controller
{
    public function index(Request $request)
    {
        // aantal gezinnen per pagina
        $perPage = 25;
        // haal het huidige pagina nummer op
        $page = $request->input('page', 1);
        // bereken de offset voor de SP
        $offset = ($page - 1) * $perPage;

        // tel hoeveel gezinnen er zijn in totaal
        $total = DB::table('families')->count();

        // probeer de SP uit te voeren om gezinnen op te halen
        try {
            $families = DB::select('CALL sp_read_families_with_packages(?, ?)', [$perPage, $offset]);
        } catch (\Exception $e) {
            // logt de fout in het logbestand
            Log::error('Error reading families with packages: ' . $e->getMessage());
            // geef een lege array terug als de SP niet bestaat of fout gaat
            $families = [];
        }

        // maak een paginator aan met de resultaten
        $families = new LengthAwarePaginator($families, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        // laad de indexpagina en geef de gezinnen mee aan de view
        return view('foodpackages.index', ['families' => $families]);
    }

    public function show($id)
    {
        // probeer de SP uit te voeren voor één gezin
        try {
            $family = DB::select('CALL sp_read_family_with_packages(?)', [$id]);
        } catch (\Exception $e) {
            // logt de fout als het ophalen niet lukt
            Log::error('Error reading family: ' . $e->getMessage());
            // stuur gebruiker terug naar overzicht met foutmelding
            return redirect()->route('foodpackages.index')
                ->with('error', 'Er is een fout opgetreden bij het ophalen van het gezin. Probeer het later opnieuw.');
        }

        // controleer of er een gezin is gevonden
        if (empty($family)) {
            // geen gezin gevonden, dus stuur terug met foutmelding
            return redirect()->route('foodpackages.index')
                ->with('error', 'Gezin niet gevonden.');
        }

        // laat de details van het gezin zien in de show pagina
        return view('foodpackages.show', ['family' => $family[0]]);
    }
}
