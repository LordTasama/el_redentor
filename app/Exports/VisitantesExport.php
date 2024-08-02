<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitantesExport implements FromCollection, WithHeadings
{
    protected $visitantes;

    public function __construct($visitantes)
    {
        $this->visitantes = $visitantes;
    }

    public function collection()
    {
        return $this->visitantes;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Documento',
            // Añade más campos si es necesario
        ];
    }
}