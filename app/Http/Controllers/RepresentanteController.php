<?php

namespace App\Http\Controllers;

use App\Models\Representante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Alert;
class RepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tramites = Representante::get();
            return DataTables::of($tramites)
            ->addColumn('actions', function ($row) {
                return '<a href="' . route('representantes.edit', [$row->id]) . '" class="btn btn-info"><span>Editar</span></a>
                        <form action="' . route('representantes.destroy', [$row->id]) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar este registro?\');">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-delete"><span>Eliminar</span></button>
                        </form>';
            })
            
                ->editColumn('fecha', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('usuario', function ($row) {
                    return $row->user->name ?? '';
                })
                ->editColumn('estado', function ($row) {
                    // Verifica el estado y devuelve un badge con el color adecuado
                    switch ($row->estado) {
                        case 'pendiente':
                            return '<span class="badge badge-danger">Pendiente</span>';
                        case 'en_proceso':
                            return '<span class="badge badge-warning">En Proceso</span>';
                        case 'completado':
                            return '<span class="badge badge-success">Completado</span>';
                        case 'rechazado':
                            return '<span class="badge badge-dark">Rechazado</span>';
                        default:
                            return '<span class="badge badge-secondary">'.$row->estado.'</span>';
                    }
                })
                ->rawColumns(['actions', 'estado'])
                ->make(true);
        } else {
            return view('representantes.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('representantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'cedula' => 'required|numeric|unique:representantes,cedula',
            'email' => 'required|email|unique:representantes,email',
            'telefono' => 'nullable|string|max:11',
            'profesion' => 'nullable|string|max:255',
            'residencia' => 'required|string|max:255', 
              // Relacionar con un usuario existente
        ]);
    
        // Crear una nueva instancia del representante
        $representante = new Representante();
        $representante->nombre = $validatedData['nombre'];
        $representante->apellido = $validatedData['apellido'];
        $representante->fecha_nacimiento = $validatedData['fecha_nacimiento'];
        $representante->cedula = $validatedData['cedula'];
        $representante->email = $validatedData['email'];
        $representante->telefono = $validatedData['telefono'];
        $representante->profesion = $validatedData['profesion'];
        $representante->residencia = $validatedData['residencia'];
        $representante->user_id = Auth::user()->id; // Asignar el usuario relacionado
    
        // Guardar el representante en la base de datos
        $representante->save();
    
        // Redirigir con un mensaje de éxito
        Alert::success('¡Exito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->route('representantes.index')->with('success', 'Representante creado exitosamente.');
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
        $representante = Representante::find($id);

        if(!$representante){
            Alert::error('¡Error!', 'Registro no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('representantes.index');
        }

        return view('representantes.edit')->with('representante', $representante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Step 2: Find the Representante record by its ID
        $representante = Representante::findOrFail($id);
    
        // Step 1: Validate the incoming request

    
        // Step 3: Update the record with the validated data
        $representante->update($request->all());
    
        // Step 4: Redirect or return a response
        Alert::success('¡Éxito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
        return redirect()->route('representantes.index')->with('success', 'Representante actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Step 1: Find the Representante record by its ID or fail with a 404 error
        $representante = Representante::findOrFail($id);
        
        // Step 2: Delete the record
        $representante->delete();
    
        // Step 3: Redirect or return a response
        Alert::success('¡Éxito!', 'Registro eliminado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
        return redirect()->route('representantes.index')->with('success', 'Representante eliminado correctamente.');
    }
    
}
