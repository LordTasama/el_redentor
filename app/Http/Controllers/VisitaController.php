<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VisitaRequest;
use App\Models\Prisionero;
use App\Models\Visitante;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
     public function searchVisitanteIds(Request $request): JsonResponse
     {
         $term = $request->query('term');
         $visitantes = Visitante::where('documento', 'like', '%' . $term . '%')->select('id', 'documento')->get();
     
         $visitanteIds = $visitantes->map(function ($item) {
             return ['id' => $item->id];
         });
     
         $visitanteDocuments = $visitantes->map(function ($item) {
             return ['documento' => $item->documento];
         });
     
         return response()->json(['visitanteIds' => $visitanteIds, 'visitanteDocuments' => $visitanteDocuments]);
     }

     
     public function searchPrisioneroIds(Request $request): JsonResponse
     {
          $term = $request->query('term');
          $prisioneroIds = Prisionero::where('id', 'like', '%' . $term . '%')->select('id')->get()->map(function ($item) {
            return ['id' => $item->id];
        });
    
         return response()->json(['prisioneroIds' => $prisioneroIds]);
     }
    

    public function index(Request $request): View
    {
        $visitas = Visita::paginate();
        $user = Auth::user();
        $auth = $user->auth;
        switch($auth){
        case 0:
            return view('waiting');
        default:
          return view('visita.index', compact('visitas'))
            ->with('i', ($request->input('page', 1) - 1) * $visitas->perPage());    
        }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $visitanteIds = Visita::pluck('visitante_id')->toArray();
        $prisioneroIds = Visita::pluck('prisionero_id')->toArray();
      
        $visita = new Visita();
    
        return view('visita.create', compact('visita', 'visitanteIds','prisioneroIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitaRequest $request): RedirectResponse
    {
        Visita::create($request->validated());

        return Redirect::route('visitas.index')
            ->with('success', 'Visita establecida exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $visita = Visita::find($id);

        return view('visita.show', compact('visita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $visitanteIds = Visita::pluck('visitante_id')->toArray();
        $prisioneroIds = Visita::pluck('prisionero_id')->toArray();
      
        $visita = Visita::find($id);

        return view('visita.edit', compact('visita', 'visitanteIds','prisioneroIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitaRequest $request, Visita $visita): RedirectResponse
    {
        $visita->update($request->validated());

        return Redirect::route('visitas.index')
            ->with('success', 'visita actualizada correctamente');
    }

    public function destroy($id): RedirectResponse
    {
        Visita::find($id)->delete();

        return Redirect::route('visitas.index')
            ->with('success', 'Visita deleted successfully');
    }
}