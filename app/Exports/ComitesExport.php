<?php

namespace App\Exports;

use App\Models\Comites;
use App\Models\Beneficiarios;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ComitesExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    public function collection()
    {
        return Comites::with('beneficiario')->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Sexo', 'Edad', 'Cargo', 'Correo', 'Teléfono', 'Clave Comité', 'Usuario', 'Contraseña', 'Firma',
            'Tipo de Obra', 'Apartado', 'Fecha de Constitución', 'Nombre del Comité',
            'Entidad Federativa', 'Municipio', 'Localidad', 'Calle', 'Número', 'Colonia', 'Código Postal',
            'Nombre del Beneficio', 'Tipo de Beneficio', 'Número de Hombres', 'Número de Mujeres', 'Presupuesto',
            'Fecha Inicial', 'Fecha Terminación', 'Nombre de la Empresa', 'Nombre del Supervisor', 'Nombre del Promotor', 'Comentarios'
        ];
    }

    public function map($comite): array
    {
        $beneficiario = $comite->beneficiario; // Solo hay un beneficiario, no un array

        return [
            $comite->id,
            $comite->nombre,
            ucfirst($comite->sexo),
            $comite->edad,
            $comite->cargo,
            $comite->correo,
            $comite->telefono, $comite->clave_comite,
            $comite->usuario,
            $comite->contrasena,
            $comite->firma,
            $beneficiario->tipo_obra ?? 'N/A',
            $beneficiario->apartado ?? 'N/A',
            $beneficiario->fecha_constitucion ?? 'N/A',
            $beneficiario->nombre_comite ?? 'N/A',
            $beneficiario->entidad_federativa_comite ?? 'N/A',
            $beneficiario->municipio_comite ?? 'N/A',
            $beneficiario->localidad_comite ?? 'N/A',
            $beneficiario->calle ?? 'N/A',
            $beneficiario->numero ?? 'N/A',
            $beneficiario->colonia ?? 'N/A',
            $beneficiario->codigo_postal ?? 'N/A',
            $beneficiario->nombre_beneficio ?? 'N/A',
            $beneficiario->tipo_beneficio ?? 'N/A',
            $beneficiario->numero_hombres ?? 0,
            $beneficiario->numero_mujeres ?? 0,
            $beneficiario->presupuesto ?? 'N/A',
            $beneficiario->fecha_inicial ?? 'N/A',
            $beneficiario->fecha_terminacion ?? 'N/A',
            $beneficiario->nombre_empresa ?? 'N/A',
            $beneficiario->nombre_supervisor ?? 'N/A',
            $beneficiario->nombre_promotor ?? 'N/A',
            $beneficiario->comentarios ?? 'N/A',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->setCellValue('G1', 'Teléfono');
            },
        ];
    }
}
