<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'especialista_id',
        'paciente_id',
        'representante_id',
        'estatus',
        'nota',
    ];

    public function especialista()
    {
        return $this->belongsTo(Especialista::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function representante()
    {
        return $this->belongsTo(Representante::class);
    }

    public function notaMedica()
    {
        return $this->hasOne(NotaMedica::class, 'cita_id');
    }
    public function asistencia()
    {
        return $this->hasOne(Asistencia::class, 'cita_id'); // Asegúrate de que 'cita_id' es la clave foránea correcta
    }
    
}
