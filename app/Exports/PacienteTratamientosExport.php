<?php

namespace App\Exports;

use App\Models\PacienteTratamiento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PacienteTratamientosExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($fechaInicio, $fechaFin)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function collection()
    {
        return PacienteTratamiento::with(['paciente', 'tratamiento', 'especialista']) // Eager load
            ->whereBetween('fecha_inicio', [$this->fechaInicio, $this->fechaFin])
            ->get()
            ->map(function ($tratamiento) {
                return [
                    'ID' => $tratamiento->id,
                    'Paciente' => optional($tratamiento->paciente)->nombre . ' ' . optional($tratamiento->paciente)->apellido,
                    'Tratamiento' => optional($tratamiento->tratamiento)->nombre,
                    'Especialista' => optional($tratamiento->especialista)->nombre . ' ' . optional($tratamiento->especialista)->apellido,
                    'Fecha Inicio' => $tratamiento->fecha_inicio,
                    'Fecha Fin' => $tratamiento->fecha_fin,
                    'Observaciones' => $tratamiento->observaciones,
                    'Estado' => $tratamiento->estatus,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Paciente',
            'Tratamiento',
            'Especialista',
            'Fecha Inicio',
            'Fecha Fin',
            'Observaciones',
            'Estado',
        ];
    }
}
