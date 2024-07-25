<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(Request $request) {
        $per_page = $request->perPage ?? 10;

        $results = Type::orderBy("name","asc")->paginate($per_page);

        return response()->json([
            'success' => true,
            'results'=> $results,

        ]);
       
    }



    public function select(Request $request)
    {
        // Recupero l'inutp della request che contiene gli slug passati dal frontEnd
        $typeSlugs = $request->input('typeSlugs');

        // messaggio di errore, se typeslugs non è un array
        if (!is_array($typeSlugs)) {
            return response()->json([
                'success' => false,
                'message' => 'typeSlugs should be an array'
            ], 400);
        }


        // Se typeSlugs è vuoto, restituisco tutte le compagnie
        if (empty($typeSlugs)) {
            $allCompanies = Company::with('types')->get();
            return response()->json([
                'success' => true,
                'results' => ['companies' => $allCompanies]
            ]);
        }
    
        // Recupero tutti i tipi, in base agli slug che ricevo.
        $types = Type::whereIn('slug', $typeSlugs)->get();
        

        

        // messaggio di errore, nel caso ci siano slug non validi
        if ($types->count() !== count($typeSlugs)) {
            return response()->json([
                'success' => false,
                'message' => 'One or more slugs are invalid'
            ], 400);
        }
    
        // Recupero gli Id di tutti i tipi
        $typeIds = $types->pluck('id');
    
        // Recupero le compagnie che sono associate a tutti i tipi
        $companies = Company::whereHas('types', function ($query) use ($typeIds) {
            $query->whereIn('types.id', $typeIds);
        }, '=', $typeIds->count())->with('types')->get(); // condizione che assicura che una compagnia debba essere associata a tutti i tipi per essere inserita nel risultato.
        

        // Ritorno la risposta in json
        return response()->json([
            'success' => true,
            'results' => ['companies' => $companies]
        ]);
    }
    
}
