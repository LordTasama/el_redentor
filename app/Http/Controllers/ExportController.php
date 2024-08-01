<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Visitante;

class ExportController extends Controller
{
public function export()
{
$visitantes = Visitante::where('documento', '1114149123' )->select('id', 'documento')->get();
return Excel::download($visitantes, 'users.xlsx');
}
}