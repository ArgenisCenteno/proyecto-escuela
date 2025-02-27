<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    // Define the fillable properties to allow mass assignment
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'cedula',
        'fecha_nacimiento',
        'especialidad',
        'nota',
        'residencia',
    ];

   
}
