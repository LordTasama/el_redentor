<?php

namespace App\Http\Controllers;

use App\Models\Prisionero;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PrisioneroRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
class PrisioneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $prisioneros = Prisionero::paginate();
        $user = Auth::user();
        $auth = $user->auth;
        switch($auth){
        case 0:
            return view('waiting');
        default:
            return view('prisionero.index', compact('prisioneros'))
            ->with('i', ($request->input('page', 1) - 1) * $prisioneros->perPage());    
        }
      

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $prisionero = new Prisionero();

        return view('prisionero.create', compact('prisionero'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrisioneroRequest $request): RedirectResponse
    {
        Prisionero::create($request->validated());

        return Redirect::route('prisioneros.index')
            ->with('success', 'Prisionero registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $prisionero = Prisionero::find($id);

        return view('prisionero.show', compact('prisionero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $prisionero = Prisionero::find($id);

        return view('prisionero.edit', compact('prisionero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrisioneroRequest $request, Prisionero $prisionero): RedirectResponse
    {
        $prisionero->update($request->validated());

        return Redirect::route('prisioneros.index')
            ->with('success', 'datos de prisionero actualizado correctamente');
    }

    public function destroy($id): RedirectResponse
    {
        Prisionero::find($id)->delete();

        return Redirect::route('prisioneros.index')
            ->with('success', 'Prisionero eliminado correctamente');
    }
}