<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrisionerosExport implements FromCollection, WithHeadings
{
    protected $prisioneros;

    public function __construct($prisioneros)
    {
        $this->prisioneros = $prisioneros;
    }

    public function collection()
    {
        return $this->prisioneros;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombres',
            'Apellidos',
            'Fecha de Nacimiento',
            'Fecha de ingreso',
            'Delito',
            'Celda'
            // Añade más campos si es necesario
        ];
    }
}