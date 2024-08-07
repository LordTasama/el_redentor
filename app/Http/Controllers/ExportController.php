<?php
namespace App\Http\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Visitante;
use App\Models\Visita;
use App\Models\Prisionero;
use App\Exports\VisitantesExport;
use App\Exports\VisitasExport;
use App\Exports\PrisionerosExport;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
    public function exportVisitas(Request $request, $option)
    {
        try {
            $request->validate([
                'fechaInicial' => 'required|date',
                'fechaFinal' => 'required|date|after:fechaInicial',
            ]);
    
            $fechaInicial = $request->query('fechaInicial');
            $fechaFinal = $request->query('fechaFinal');
    
            $visitas = Visita::join('prisioneros', 'prisioneros.id', '=', 'prisionero_id')
                ->join('visitantes', 'visitantes.id', '=', 'visitante_id')
                ->select(
                    'visitas.id',
                    'prisionero_id',
                    'visitante_id',
                    'prisioneros.nombres as prisionero_nombres',
                    'prisioneros.apellidos as prisionero_apellidos',
                    'visitantes.nombres as visitante_nombres',
                    'visitantes.apellidos as visitante_apellidos',
                    'inicioVisita',
                    'finVisita'
                )
                ->whereBetween('inicioVisita', [$fechaInicial, $fechaFinal])
                ->get();
    
            if ($option == 'xlsx') {
             $data = collect($visitas);
             return Excel::download(new VisitasExport($visitas), 'visitas-rango.xlsx');
            }
            else if($option == "pdf"){
              // Obtener datos de los usuarios
     

        // Configurar opciones de DomPDF (opcional)
        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Crear instancia de Dompdf
        $dompdf = new Dompdf($options);

       // Construir contenido HTML directamente
       $html = '<html>';
       $html .= '<head><title>Listado de Visitas</title></head>';
       $html .= '<body>';
       $html .= '<h2>Listado de Visitas</h2>';
       $html .= '<table border="1" style="width:100%; border-collapse: collapse;">';
       $html .= '<thead>';
       $html .= '<tr>';
       $html .= '<th>ID</th>';
       $html .= '<th>Prisionero ID</th>';
       $html .= '<th>Visitante ID</th>';
       $html .= '<th>Nombre del Prisionero</th>';
       $html .= '<th>Apellido del Prisionero</th>';
       $html .= '<th>Nombre del Visitante</th>';
       $html .= '<th>Apellido del Visitante</th>';
       $html .= '<th>Inicio de Visita</th>';
       $html .= '<th>Fin de Visita</th>';
       $html .= '</tr>';
       $html .= '</thead>';
       $html .= '<tbody>';

       foreach ($visitas as $visita) {
           $html .= '<tr>';
           $html .= '<td>' . $visita->id . '</td>';
           $html .= '<td>' . $visita->prisionero_id . '</td>';
           $html .= '<td>' . $visita->visitante_id . '</td>';
           $html .= '<td>' . $visita->prisionero_nombres . '</td>';
           $html .= '<td>' . $visita->prisionero_apellidos . '</td>';
           $html .= '<td>' . $visita->visitante_nombres . '</td>';
           $html .= '<td>' . $visita->visitante_apellidos . '</td>';
           $html .= '<td>' . $visita->inicioVisita . '</td>';
           $html .= '<td>' . $visita->finVisita . '</td>';
           $html .= '</tr>';
       }
       
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</body>';
        $html .= '</html>';

        // Cargar HTML en Dompdf
        $dompdf->loadHtml($html);

        // Renderizar PDF
        $dompdf->render();

        // Descargar PDF
        return $dompdf->stream('visitas.pdf');
            }
    
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422); // 422 Unprocessable Entity
        }
    
        // Agregar cualquier otra lógica o manejo de errores según sea necesario
    
        // Si se llega aquí y $option no es 'Excel', podrías retornar un error 404 o 400, dependiendo del contexto
        $error = ['error'=>['error'=>['Opción no válida']]];
        return response()->json($error,400);
    }
    
     public function exportPrisionerosIngreso(Request $request,$option)
    {
        try {
                $request->validate(["fechaInicial"=>["required","date"],"fechaFinal"=>["required","date","after:fechaInicial"]]);
                $fechaInicial = $request->query('fechaInicial');
                $fechaFinal = $request->query('fechaFinal');
                $prisioneros = Prisionero::select('id','nombres','apellidos','nacimiento','ingreso','delito','celda')->whereBetween('ingreso',[$fechaInicial,$fechaFinal])->get(); 
                if($option == 'xlsx'){
                $data = collect($prisioneros);
                return Excel::download(new PrisionerosExport($prisioneros), 'prisioneros-rango.xlsx');
                }
                else if($option == "pdf"){
                       // Configurar opciones de DomPDF (opcional)
        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Crear instancia de Dompdf
        $dompdf = new Dompdf($options);

        // Construir contenido HTML directamente
        $html = '<html>';
        $html .= '<head><title>Listado de Prisioneros</title></head>';
        $html .= '<body>';
        $html .= '<h2>Listado de Prisioneros</h2>';
        $html .= '<table border="1" style="width:100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>ID</th>';
        $html .= '<th>Nombres</th>';
        $html .= '<th>Apellidos</th>';
        $html .= '<th>Fecha de Nacimiento</th>';
        $html .= '<th>Fecha de Ingreso</th>';
        $html .= '<th>Delito</th>';
        $html .= '<th>Celda</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($prisioneros as $prisionero) {
            $html .= '<tr>';
            $html .= '<td>' . $prisionero->id . '</td>';
            $html .= '<td>' . $prisionero->nombres . '</td>';
            $html .= '<td>' . $prisionero->apellidos . '</td>';
            $html .= '<td>' . $prisionero->nacimiento . '</td>'; // Asegúrate de formatear según sea necesario
            $html .= '<td>' . $prisionero->ingreso . '</td>'; // Asegúrate de formatear según sea necesario
            $html .= '<td>' . $prisionero->delito . '</td>';
            $html .= '<td>' . $prisionero->celda . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</body>';
        $html .= '</html>';

        // Cargar HTML en Dompdf
        $dompdf->loadHtml($html);

        // Renderizar PDF
        $dompdf->render();

        // Descargar PDF
        return $dompdf->stream('prisioneros.pdf');
                }
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422); // 422 Unprocessable Entity
        }
    
        // Agregar cualquier otra lógica o manejo de errores según sea necesario
    
        // Si se llega aquí y $option no es 'Excel', podrías retornar un error 404 o 400, dependiendo del contexto
        $error = ['error'=>['error'=>['Opción no válida']]];
        return response()->json($error,400);
    }
       
    
    
}