<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteTratamiento extends Model
{
    use HasFactory;
    protected $table = 'paciente_tratamiento';

    protected $fillable = [
        'paciente_id',
        'tratamiento_id',
        'especialista_id',
        'fecha_inicio',
        'fecha_fin',
        'observaciones',
        'estatus'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }

    public function especialista()
    {
        return $this->belongsTo(Especialista::class);
    }
}
