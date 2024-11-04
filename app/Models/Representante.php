<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'representantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'cedula',
        'email',
        'telefono',
        'profesion',
        'residencia',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
       
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
