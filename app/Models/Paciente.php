<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'cedula',
        'estatura',
        'tipo_sangre',
        'lateralidad',
        'posee_discapacidad',
        'nota',
        'representante_id',
        'colegio',
        'grado',
    ];
 
     public function representante()
    {
         return $this->belongsTo(Representante::class);
     }
}
