<?php

namespace App\Exports;

use App\Models\Cita;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitasExport implements FromCollection, WithHeadings, ShouldAutoSize
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
        return Cita::with(['paciente', 'representante', 'especialista', 'asistencia']) // Eager load relaciones
            ->whereBetween('fecha', [$this->fechaInicio, $this->fechaFin])
            ->get()
            ->map(function ($cita) {
                return [
                    'ID' => $cita->id,
                    'Fecha' => $cita->fecha,
                    'Hora' => $cita->hora,
                    'Especialista' => optional($cita->especialista)->nombre . ' ' . optional($cita->especialista)->apellido,
                    'Paciente' => optional($cita->paciente)->nombre . ' ' . optional($cita->paciente)->apellido,
                    'Representante' => optional($cita->representante)->nombre . ' ' . optional($cita->representante)->apellido,
                    'Estado' => $cita->estatus,
                    'Nota' => $cita->nota,
                    'Asistencia' => optional($cita->asistencia)->estado, // Agrega el estado de asistencia
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Hora',
            'Especialista',
            'Paciente',
            'Representante',
            'Estado',
            'Nota',
            'Asistencia', // Encabezado para el estado de asistencia
        ];
    }
}
