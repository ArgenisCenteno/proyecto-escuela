<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cita;
use App\Models\Especialista;
use App\Models\NotaMedica;
use App\Models\Paciente;
use App\Models\PacienteTratamiento;
use App\Models\Representante;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pacientes = Paciente::count();
        $representantes = Representante::count();
        $especialistas = Especialista::count();
        $citas = Cita::count();
        $citas2 = Cita::where('estatus', 'Pendiente')->count();
        $asistencias = Asistencia::count();
        $notas = NotaMedica::count();
        $tratamientos = PacienteTratamiento::where('estatus', 'En proceso')->count();

        // Agrupar y contar productos (si es necesario)
       
        $bajoStock = 0;
       
        $tramitesPorMes = [];
        $data = [];
    // Formatear los datos para la gráfica
    $data2 = [];
    foreach ($tramitesPorMes as $tramite) {
        $data2[$tramite->mes][$tramite->tipo] = $tramite->total;
    }
       
    //dd($data2);
        return view('home', [
            'tramites' => $pacientes,
            'productos' => $representantes,
            'solicitudes' => $especialistas,
            'asignaciones' => $citas,
            'proveedores' => $citas2,
            'requerimientos' => $asistencias,
            'personal' => $notas,
            'bajoStock' => $tratamientos,
            'dataProductos' => $data,
            'tramitesPorMes' => $data2,
        ]);
    }
}
