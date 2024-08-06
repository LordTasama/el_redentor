<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitasExport implements FromCollection, WithHeadings
{
    protected $visitas;

    public function __construct($visitas)
    {
        $this->visitas = $visitas;
    }

    public function collection()
    {
        return $this->visitas;
    }

    public function headings(): array
    {
        return [
            'Id de  la visita',
             'Id del prisionero',
            'Identificación del visitante',
            'Nombres del prisionero',
            'Apellidos del prisionero',
            'Nombres del visitante','Apellidos del visitante', 
            'Inicio de la visita',
            'Fin de la visita'
            // Añade más campos si es necesario
        ];
    }
}