<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Prisionero;
use App\Exports\VisitantesExport;
use App\Exports\VisitasExport;
use App\Exports\PrisionerosExport;
use Illuminate\Http\Request;
class ExportController extends Controller
{
 public function exportPrisioneros()
    {
        $prisioneros = Prisionero::all()->select('id','nombres','apellidos','nacimiento','ingreso','delito','celda');

        return Excel::download(new PrisionerosExport($prisioneros), 'prisioneros.xlsx');
    }
    public function exportVisitas()
    {
        $visitas = Visita::all()->select('id','visitante_id','prisionero_id','inicioVisita','finVisita');

        return Excel::download(new VisitasExport($visitas), 'visitas.xlsx');
    }
    public function exportVisitantes()
    {
        $visitantes = Visitante::all()->select('id','nombres','apellidos','documento');

        return Excel::download(new VisitantesExport($visitantes), 'visitantes.xlsx');
    }

     public function queryResultVisitantes(Request $request)
     {
         
        
         return response()->json([$request->all()]);
     }
     
     public function queryResultVisitas(Request $request)
     {
          // Validar los parámetros de entrada
    $request->validate([
        'startDate' => 'required|date',
        'endDate' => 'required|date',
    ]);

    // Obtener los parámetros de entrada
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    // Realizar la consulta
    $visitas = Visita::select('prisionero_id', 'visitante_id', Visita::raw('COUNT(*) as total_visitas'))
        ->whereBetween('inicioVisita', [$startDate, $endDate]) // Filtrar por rango de fechas
        ->groupBy('prisionero_id', 'visitante_id') // Agrupar por prisionero_id y visitante_id
        ->orderBy('total_visitas', 'desc') // Ordenar por el conteo de visitas en orden descendente
        ->limit(5) // Limitar a 5 resultados
        ->get();

    // Obtener el conteo total de visitas por prisionero_id en el rango de fechas
    $totalCount = Visita::select('prisionero_id', Visita::raw('COUNT(*) as total_visitas'))
        ->whereBetween('inicioVisita', [$startDate, $endDate])
        ->groupBy('prisionero_id')
        ->count(); // Conteo de grupos (prisionero_id)

    // Construir la respuesta JSON
    $response = [
        'totalCount' => $totalCount,
        'data' => $visitas
    ];

    return response()->json($response);
     }
}