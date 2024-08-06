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
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
class ExportController extends Controller
{
    public function export($tipo, $option = null, Request $request)
    {

        switch ($tipo) {
            case 'visitantes':
                return $this->exportVisitantes();
            case 'prisioneros':
                return $this->exportPrisioneros();
            case 'visitas':
                return $this->exportVisitas($request,$option);
            case 'prisioneros-rango':
                return $this->exportPrisionerosIngreso($request,$option);
            default:
                abort(404); // Si el tipo no es válido, retorna un error 404
        }
    }
 public function exportPrisioneros()
    {
        $prisioneros = Prisionero::all()->select('id','nombres','apellidos','nacimiento','ingreso','delito','celda');

        return Excel::download(new PrisionerosExport($prisioneros), 'prisioneros.xlsx');
    }
    
    public function exportVisitantes()
    {
        $visitantes = Visitante::all()->select('id','nombres','apellidos','documento');

        return Excel::download(new VisitantesExport($visitantes), 'visitantes.xlsx');
    }
    public function exportVisitas(Request $request,$option)
    {
        // Definir reglas de validación
        $rules = [
            'fechaInicial' => 'required|date',
            'fechaFinal' => 'required|date|after:fechaInicial',
        ];

        // Validar los datos
        $validator = Validator::make($request->all(), $rules);

        // Capturar excepción de validación si ocurre
        try {
            $validator->validate();
        } catch (ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
    }

       if($option == 'Excel'){
        $fechaInicial = $request->query('fechaInicial');
        $fechaFinal = $request->query('fechaFinal');

        $visitas = Visita::join('prisioneros','prisioneros.id','=','prisionero_id')->join('visitantes','visitantes.id','=','visitante_id')->select("visitas.id",'prisionero_id','visitante_id','prisioneros.nombres', 'prisioneros.apellidos','visitantes.nombres','visitantes.apellidos','inicioVisita','finVisita')->whereBetween('inicioVisita', [$fechaInicial, $fechaFinal])->get();
        return Excel::download(new VisitasExport($visitas), 'visitas-rango.xlsx');
            }
    }
     public function exportPrisionerosIngreso(Request $request,$option)
    {
        if($option == 'Excel'){
        $request->validate(["fechaInicial"=>["required","date"],"fechaFinal"=>["required","date","after:fechaInicial"]]);
        $fechaInicial = $request->query('fechaInicial');
        $fechaFinal = $request->query('fechaFinal');
        $prisioneros = Prisionero::select('id','nombres','apellidos','nacimiento','ingreso','delito','celda')->whereBetween('ingreso',[$fechaInicial,$fechaFinal])->get(); 
        return Excel::download(new PrisionerosExport($prisioneros), 'prisioneros-rango.xlsx');
        }
    }
  
    
}