<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class Reportes extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $auth = $user->auth;
        switch($auth){
        case 1:
             return view('reports.index');   
            
        default:
        return Redirect::back()
        ->withErrors(['error' => 'No tiene los permisos necesarios para ingresar.']);
}
    
    }
}