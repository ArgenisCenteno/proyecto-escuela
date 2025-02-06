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
                    'Niño' => $paciente->nombre . ' ' . $paciente->apellido,
                    'Genero' => $paciente->genero,
                    'Discapacidad' => $paciente->nota,
                    
                    'Representante' => optional($paciente->representante)->nombre . ' ' . optional($paciente->representante)->apellido,
                ];
            });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Niño',
            'Genero',
            'Discapacidad',
            'Representante', 
        ];
    }

   /* public function headings(): array
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
    } */
}
