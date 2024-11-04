<?php

namespace App\Exports;

use App\Models\Paciente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PacientesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Paciente::with('representante') // Eager load
            ->get()
            ->map(function ($paciente) {
                return [
                    'ID' => $paciente->id,
                    'Nombre Completo' => $paciente->nombre . ' ' . $paciente->apellido,
                    'Fecha de Nacimiento' => $paciente->fecha_nacimiento,
                    'Cédula' => $paciente->cedula,
                    'Estatura' => $paciente->estatura,
                    'Tipo de Sangre' => $paciente->tipo_sangre,
                    'Lateralidad' => $paciente->lateralidad,
                    'Posee Discapacidad' => $paciente->posee_discapacidad ? 'Sí' : 'No',
                    'Nota' => $paciente->nota,
                    'Colegio' => $paciente->colegio,
                    'Grado' => $paciente->grado,
                    'Representante' => optional($paciente->representante)->nombre . ' ' . optional($paciente->representante)->apellido,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre Completo',
            'Fecha de Nacimiento',
            'Cédula',
            'Estatura',
            'Tipo de Sangre',
            'Lateralidad',
            'Posee Discapacidad',
            'Nota',
            'Colegio',
            'Grado',
            'Representante',
        ];
    }
}
