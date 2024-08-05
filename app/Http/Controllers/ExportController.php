<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Prisionero;
use App\Exports\VisitantesExport;
use App\Exports\VisitasExport;
use App\Exports\PrisionerosExport;
class ExportController extends Controller
{
 public function exportPrisioneros()
    {
        $visitantes = Prisionero::all()->select('id','nombres','apellidos','nacimiento','ingreso','delito','celda');

        return Excel::download(new PrisionerosExport($visitantes), 'prisioneros.xlsx');
    }
    public function exportVisitas()
    {
        $visitas = Visita::all()->select('id','visitante_id','prisionero_id','inicioVisita','finVisita');

        return Excel::download(new VisitasExport($visitas), 'visitas.xlsx');
    }
    public function exportVisitantes()
    {
        $prisioneros = Visitante::all()->select('id','nombres','apellidos','documento');

        return Excel::download(new VisitantesExport($prisioneros), 'visitantes.xlsx');
    }
}