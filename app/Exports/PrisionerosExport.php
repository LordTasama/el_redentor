<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class PrisionerosExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $prisioneros;

    public function __construct(Collection $prisioneros)
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
            ['El Redentor'], // Título
            [
                'ID',
                'Nombres',
                'Apellidos',
                'Fecha de Nacimiento',
                'Fecha de ingreso',
                'Delito',
                'Celda'
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Unir celdas para el título
        $sheet->mergeCells('A1:G1');

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
        $sheet->getStyle('A2:G2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}