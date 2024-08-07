<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class VisitasExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $visitas;

    public function __construct(Collection $visitas)
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
            ['El Redentor'], // Título
            [
                'Id de la visita',
                'Id del prisionero',
                'Identificación del visitante',
                'Nombres del prisionero',
                'Apellidos del prisionero',
                'Nombres del visitante',
                'Apellidos del visitante',
                'Inicio de la visita',
                'Fin de la visita'
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Unir celdas para el título
        $sheet->mergeCells('A1:I1');

        // Aplicar estilo al título "El Redentor"
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
                'size' => 16,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '007BFF'], // Color primario de Bootstrap
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Aplicar estilo a las cabeceras
        $sheet->getStyle('A2:I2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}