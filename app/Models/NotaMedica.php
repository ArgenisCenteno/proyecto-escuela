<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaMedica extends Model
{
    use HasFactory;
    protected $table = 'notas_medicas';
    protected $fillable = [
        'cita_id',
        'especialista_id',
        'nota',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function especialista()
    {
        return $this->belongsTo(Especialista::class);
    }
}
