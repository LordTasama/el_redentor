<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WaitingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('/waiting');
    } 
}