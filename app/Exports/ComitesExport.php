<?php

namespace App\Exports;

use App\Models\Comites;
use App\Models\Beneficiarios;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class ComitesExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithStyles
{
    protected $totalMonto = 0;

    public function collection()
    {
        // Obtener todos los comités sin repetirlos
        $comites = Comites::with('beneficiario')
            ->select('clave_comite')
            ->groupBy('clave_comite')
            ->get();

        // Calcular el total del monto federal vigilado
        $this->totalMonto = Beneficiarios::sum('presupuesto');

        return $comites;
    }

    public function headings(): array
    {
        return [
            '#', 'Comité', 'Clave de la Instancia Normativa', 'Monto Federal Vigilado',
            'Entidad', 'Municipio', 'Localidad', 'Masculino', 'Femenino', 'Total Integrantes', 'Fecha de Constitución'
        ];
    }

    public function map($comite): array
    {
        $beneficiario = Beneficiarios::where('clave_comite', $comite->clave_comite)->first();

        // Contar los integrantes masculinos y femeninos en este comité
        $masculino = Comites::where('clave_comite', $comite->clave_comite)->where('sexo', 'Masculino')->count();
        $femenino = Comites::where('clave_comite', $comite->clave_comite)->where('sexo', 'Femenino')->count();
        $total = $masculino + $femenino;

        return [
            $beneficiario->id ?? 'N/A',
            $beneficiario->nombre_comite ?? 'N/A',
            $beneficiario->clave_comite ?? 'N/A',
            $beneficiario->presupuesto ?? 0, // Se aplicará el formato de moneda en AfterSheet
            $beneficiario->entidad_federativa_comite ?? 'N/A',
            $beneficiario->municipio_comite ?? 'N/A',
            $beneficiario->localidad_comite ?? 'N/A',
            $masculino,
            $femenino,
            $total,
            $beneficiario->fecha_constitucion ?? 'N/A'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '800000']],
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center']
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();
                $totalRow = $lastRow + 1;

                // Aplicar bordes a todas las celdas con datos
                $sheet->getStyle("A1:K$totalRow")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Establecer tamaño automático de las columnas
                foreach (range('A', 'K') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Aplicar color a filas alternas
                for ($row = 2; $row <= $lastRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle("A{$row}:K{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => 'solid',
                                'startColor' => ['rgb' => 'E5E5E5'], // Gris claro
                            ],
                        ]);
                    }
                }

                // Centrar todo el contenido
                $sheet->getStyle("A1:K$totalRow")->getAlignment()->setHorizontal('center');
                $sheet->getStyle("A1:K$totalRow")->getAlignment()->setVertical('center');

                // Formato de moneda ($ pesos mexicanos) en la columna "Monto Federal Vigilado"
                $sheet->getStyle("D2:D$totalRow")->getNumberFormat()->setFormatCode('"$"#,##0.00');

                // Agregar la fila con el total del monto federal vigilado
                $sheet->setCellValue("C$totalRow", "TOTAL");
                $sheet->setCellValue("D$totalRow", $this->totalMonto);

                // Aplicar estilo especial a la fila total
                $sheet->getStyle("A$totalRow:K$totalRow")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4A4A4A']],
                    'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
                ]);

                $sheet->getProtection()->setSheet(false);
            },
        ];
    }
}
