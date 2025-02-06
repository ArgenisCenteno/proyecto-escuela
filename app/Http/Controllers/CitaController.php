<?php

namespace App\Http\Controllers;

use App\Exports\CitasExport;
use App\Models\Asistencia;
use App\Models\Cita;
use App\Models\Especialista;
use App\Models\NotaMedica;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Alert; 
class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tramites = Cita::with('paciente', 'representante', 'especialista', 'asistencia')->get();
        //  dd($tramites);
            return DataTables::of($tramites)
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('citas.edit', [$row->id]) . '" class="btn btn-info"><span>Editar</span></a>
                         <a href="' . route('pacientes.pdf', [$row->paciente_id]) . '" class="btn btn-success" target="_blank"><span> PDF</span></a>
                    <form action="' . route('citas.destroy', [$row->id]) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar este registro?\');">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-delete"><span>Eliminar</span></button>
                        </form>';
                })

                ->editColumn('fecha', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('fecha_creacion', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('estatus', function ($row) {
                    switch ($row->estatus) {
                        case 'Pendiente':
                            return '<span class="badge badge-danger">Pendiente</span>';
                        case 'Confirmada':
                            return '<span class="badge badge-info">Confirmada</span>';
                        case 'Completada':
                            return '<span class="badge badge-success">Completada</span>';
                        case 'Cancelada':
                            return '<span class="badge badge-warning">Cancelada</span>';
                        default:
                            return '<span class="badge badge-secondary">Sin estado</span>'; // Para manejar valores no esperados
                    }
                })
                
                ->editColumn('especialista', function ($row) {
                    if($row->especialista != null){
                       // dd($row->especialista);
                        return $row->especialista->nombre . ' ' . $row->especialista->apellido;

                    }else{
                        return 'S/N';

                    }
                })
                ->editColumn('paciente', function ($row) {
                    return $row->paciente->nombre . ' ' . $row->paciente->apellido;
                })
                ->editColumn('representante', function ($row) {
                    return $row->representante->nombre . ' ' . $row->representante->apellido;
                })
                ->editColumn('asistencia', function ($row) {
                    if(isset($row->asistencia->estado) ){
                        switch ($row->asistencia->estado) {
                            case 'Tarde':
                                return '<span class="badge badge-danger">Tarde</span>';
                            case 'Asistió':
                                return '<span class="badge badge-info">Asistió</span>';
                            case 'No asistió':
                                return '<span class="badge badge-success">No asistió</span>';
                            
                            default:
                                return '<span class="badge badge-dark">No ha empezado</span>'; // Para manejar valores no esperados
                        }
                    }else{
                        return '<span class="badge badge-dark">No ha empezado</span>'; // Para manejar valores no esperados
                    }
                    
                })
                ->rawColumns(['actions', 'estatus', 'asistencia'])
                ->make(true);
        } else {
            return view('citas.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pacientes = Paciente::get();
        $especialistas = Especialista::get();
        return view('citas.create')->with('pacientes', $pacientes)->with('especialistas', $especialistas);
    }

    /**
     * Store a newly created resource in storage.
     */
   

    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'hora' => 'required',
            'fecha' => 'required|date|after_or_equal:today',
            'especialista_id' => 'required|exists:especialistas,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'representante_id' => 'nullable|exists:representantes,id', 
            'estatus' => 'required|in:Pendiente,Confirmado,Cancelado',
            'nota' => 'nullable|string|max:255',
        ]);
    
        // Convertir la hora en formato 24 horas H:i
        $hora = Carbon::createFromFormat('h:i A', $request->hora)->format('H:i');
    
        // Verificar si ya existe un conflicto en la cita
        $conflicto = Cita::where('especialista_id', $request->especialista_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $hora)
            ->exists();
    
        if ($conflicto) {
            Alert::error('¡Error!', 'El especialista seleccionado ya tiene cita en esta fecha y hora.')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }
    
        // Verificar existencia del paciente
        $paciente = Paciente::find($request->paciente_id);
        if (!$paciente) {
            Alert::error('¡Error!', 'Paciente no registrado.')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }
    
        // Verificar existencia del especialista
        $especialista = Especialista::find($request->especialista_id);
        if (!$especialista) {
            Alert::error('¡Error!', 'Especialista no registrado.')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }
    
        // Crear la nueva cita
        Cita::create([
            'fecha' => $request->fecha,
            'hora' => $hora,  // Hora en formato 24 horas
            'especialista_id' => $especialista->id,
            'paciente_id' => $paciente->id,
            'representante_id' => $paciente->representante->id,
            'estatus' => $request->estatus,
            'nota' => $request->nota,
        ]);
    
        Alert::success('¡Éxito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
        return redirect()->route('citas.index')->with('success', 'Cita registrada con éxito.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cita = Cita::with('notaMedica')->find($id);
        $nota = NotaMedica::where('cita_id', $cita->id)->first();
        $asistencia = Asistencia::where('cita_id', $cita->id)->first();
      
        $pacientes = Paciente::get();
        $especialistas = Especialista::get();

        
        if (!$cita) {
            Alert::error('¡Error!', 'Registro no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        }
        //dd($cita->notaMedica);
        return view('citas.edit')->with('cita', $cita)->with('especialistas', $especialistas)->with('pacientes', $pacientes)->with('nota', $nota)->with('asistencia', $asistencia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'especialista_id' => 'required|exists:especialistas,id',
            'paciente_id' => 'required|exists:pacientes,id',
        ]);

        $conflicto = Cita::where('especialista_id', $request->especialista_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('paciente_id', '!=', $request->paciente_id)
            ->exists();

        if ($conflicto) {
            Alert::error('¡Error!', 'El especialista seleccionado ya tiene cita en esta fecha y hora.')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->back();
        }

        $cita = Cita::findOrFail($id);
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->especialista_id = $request->especialista_id;
        $cita->paciente_id = $request->paciente_id;
        $cita->nota = $request->nota_cita;
        $cita->estatus = $request->estatus;
        $cita->save();

        $nota = NotaMedica::where('cita_id', $cita->id)->first();
      //  dd($request->nota != null);
        if(!$nota && $request->nota_cita != null){
            $nuevo = new NotaMedica();
            $nuevo->cita_id = $id;
            $nuevo->especialista_id = $request->especialista_id;
            $nuevo->nota = $request->nota_medica;
            $nuevo->save();
        }elseif($nota && $request->nota_cita != null){
            $nota->cita_id = $id;
            $nota->especialista_id = $request->especialista_id;
            $nota->nota = $request->nota_medica;
            $nota->save();
        }

        $asistencia = Asistencia::where('cita_id', $cita)->first();
        if(!$asistencia  && $request->asistencia != ''){
            $nuevo = new Asistencia();
            $nuevo->cita_id = $id;
            $nuevo->estado = $request->asistencia;
            $nuevo->observacion = $request->observacion_asistencia ?? '';
            $nuevo->save();
        }elseif($asistencia && $request->asistencia != ''){
          
            $nota->observacion = $request->observacion_asistencia ?? '';
            $nota->estado = $request->asistencia;
            $nota->save();
        }

        Alert::success('¡Exito!', 'Registro actualizado correctamente.')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        
        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Step 1: Find the Representante record by its ID or fail with a 404 error
        $representante = Cita::findOrFail($id);

        // Step 2: Delete the record
        $representante->delete();

        // Step 3: Redirect or return a response
        Alert::success('¡Éxito!', 'Registro eliminado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('citas.index')->with('success', 'Representante eliminado correctamente.');
    }

    public function export(Request $request)
    {
        // Validar las fechas
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Generar el export
        return Excel::download(new CitasExport($request->fecha_inicio, $request->fecha_fin), 'citas_' . date('Y-m-d') . '.xlsx');
    }
}
