<?php

use App\Http\Controllers\PrisioneroController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\Reportes;
use App\Http\Controllers\ExportController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

// routes/web.php

Route::get('/exportar/{tipo}/{option}', [ExportController::class, 'export'])->name('exportar');
Route::get('/visitas/search-visitante-ids', [VisitaController::class, 'searchVisitanteIds']);
Route::get('/visitas/search-prisionero-ids', [VisitaController::class, 'searchPrisioneroIds']);
Route::get('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reportes', [Reportes::class, 'index'])->name('reportes');
Route::resource('/visitas', VisitaController::class)->middleware('auth');
Route::resource('/visitantes', VisitanteController::class)->middleware('auth');
Route::resource('/prisioneros', PrisioneroController::class)->middleware('auth');