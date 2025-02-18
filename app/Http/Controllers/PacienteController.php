<?php

namespace App\Http\Controllers;

use App\Exports\PacientesExport;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\PacienteTratamiento;
use App\Models\Representante;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Alert;
use PDF;
class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tramites = Paciente::get();
            return DataTables::of($tramites)
            ->addColumn('actions', function ($row) {
                return '<a href="' . route('pacientes.edit', [$row->id]) . '" class="btn btn-info"><span>Editar</span></a>
                    <form action="' . route('pacientes.destroy', [$row->id]) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar este registro?\');">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-delete"><span>Eliminar</span></button>
                    </form>
                  
                     <a href="' . route('pacientes.pdfCedula', [$row->id]) . '" class="btn btn-warning" target="_blank"><span> Cédula</span></a>
                    ';
            })
            

                ->editColumn('fecha', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('discapacidad', function ($row) {
                    return $row->posee_discapacidad
                        ?  $row->nota // For value 1
                        : '<span class="badge badge-danger">No</span>';  // For value 0 or null
                })

                ->editColumn('representante', function ($row) {
                    return $row->representante->nombre . $row->representante->apellido ?? '';
                })
                ->rawColumns(['actions', 'discapacidad'])
                ->make(true);
        } else {
            return view('pacientes.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $representantes = Representante::get();

        return view('pacientes.create')->with('representantes', $representantes);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today', // Ensure the date is before today
            'genero' => 'required|string|max:255',
            'peso' => 'required|numeric|min:3|max:200',
            'estatura' => 'required|numeric|min:0',
            'tipo_sangre' => 'required|string',
            'lateralidad' => 'required|string',
            'posee_discapacidad' => 'required|boolean',
            'nota' => 'nullable|string',
            'representante_id' => 'required|exists:representantes,id', // Ensure the representative exists
            'colegio' => 'required|string|max:255',
            'grado' => 'required|string|max:50',
        ]);

        // Create a new Paciente record
        $paciente = Paciente::create($validatedData);
        Alert::success('¡Éxito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        // Optionally, redirect or return a response
        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado exitosamente.');
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
        $representantes = Representante::get();
        $paciente = Paciente::find($id);
        if (!$paciente) {
            Alert::error('¡Error!', 'Registro no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }

        return view('pacientes.edit')->with('representantes', $representantes)->with('paciente', $paciente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'peso' => 'required|numeric|min:3|max:200',
            'estatura' => 'required|numeric',
            'tipo_sangre' => 'required|string',
            'lateralidad' => 'required|string',
            'posee_discapacidad' => 'required|boolean',
            'nota' => 'nullable|string',
            'representante_id' => 'required|exists:representantes,id',
            'colegio' => 'required|string|max:255',
            'grado' => 'required|string|max:255',
        ]);

        // Find the patient by ID
        $paciente = Paciente::findOrFail($id);
        if (!$paciente) {
            Alert::error('¡Error!', 'Registro no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }
        // Update the patient's attributes
        $paciente->nombre = $request->input('nombre');
        $paciente->apellido = $request->input('apellido');
        $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
        $paciente->cedula = $request->input('cedula');
        $paciente->estatura = $request->input('estatura');
        $paciente->tipo_sangre = $request->input('tipo_sangre');
        $paciente->lateralidad = $request->input('lateralidad');
        $paciente->posee_discapacidad = $request->input('posee_discapacidad');
        $paciente->nota = $request->input('nota');
        $paciente->representante_id = $request->input('representante_id');
        $paciente->colegio = $request->input('colegio');
        $paciente->grado = $request->input('grado');
        $paciente->genero = $request->input('genero');
        $paciente->peso = $request->input('peso');
        // Save the updated patient record
        $paciente->save();

        // Redirect back to a specific route with a success message
        Alert::success('¡Éxito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        if (!$paciente) {
            Alert::error('¡Error!', 'Registro no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }

        $paciente->delete();
        Alert::success('¡Éxito!', 'Registro eliminado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    public function export()
    {
        return Excel::download(new PacientesExport, 'pacientes.xlsx');
    }

    public function pdf($id)
    {
        // Obtener el paciente por su ID
        $paciente = Paciente::findOrFail($id);
        
        // Obtener citas y tratamientos asociados al paciente
        $citas = Cita::where('paciente_id', $paciente->id)->get();
        $tratamientos = PacienteTratamiento::where('paciente_id', $paciente->id)->get();
        //dd($tratamientos);
        // Generar el PDF
        $pdf = PDF::loadView('pacientes.pdf', [
            'paciente' => $paciente,
            'citas' => $citas,
            'tratamientos' => $tratamientos,
        ]);
    
        // Establecer el nombre del archivo como el nombre completo del paciente
        $nombreCompleto = strtoupper($paciente->nombre . ' ' . $paciente->apellido);
        $nombreArchivo = 'registro_' . $nombreCompleto . '.pdf';
    
        // En lugar de descargar, hacer streaming del PDF
        return $pdf->stream($nombreArchivo);
    }
    
    public function pdfCedula($id)
    {
        // Obtener el paciente por su ID
        $paciente = Paciente::findOrFail($id);
        
        // Obtener citas y tratamientos asociados al paciente
        $citas = Cita::where('paciente_id', $paciente->id)->get();
        $tratamientos = PacienteTratamiento::where('paciente_id', $paciente->id)->get();
        //dd($tratamientos);
        // Generar el PDF
        $pdf = PDF::loadView('pacientes.pdfCedula', [
            'paciente' => $paciente,
            'citas' => $citas,
            'tratamientos' => $tratamientos,
        ]);
    
        // Establecer el nombre del archivo como el nombre completo del paciente
        $nombreCompleto = strtoupper($paciente->nombre . ' ' . $paciente->apellido);
        $nombreArchivo = 'registro_' . $nombreCompleto . '.pdf';
    
        // En lugar de descargar, hacer streaming del PDF
        return $pdf->stream($nombreArchivo);
    }

}
