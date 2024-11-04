<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;
class EspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tramites = Especialista::get();
            return DataTables::of($tramites)
            ->addColumn('actions', function ($row) {
                return '<a href="' . route('especialistas.edit', [$row->id]) . '" class="btn btn-info"><span>Editar</span></a>
                        <form action="' . route('especialistas.destroy', [$row->id]) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar este registro?\');">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-delete"><span>Eliminar</span></button>
                        </form>';
            })
            
                ->editColumn('fecha', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
              
                
                ->rawColumns(['actions'])
                ->make(true);
        } else {
            return view('especialistas.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('especialistas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:especialistas,email',
            'telefono' => 'required|string|max:15',
            'cedula' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'required|date',
            'especialidad' => 'required|string|max:255',
            'nota' => 'nullable|string',
            'residencia' => 'nullable|string|max:255',
        ]);

        // Create the specialist
        Especialista::create($request->all());

        // Redirect or return response
        Alert::success('¡Éxito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('especialistas.index')->with('success', 'Especialista registrado exitosamente.');
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
        $especialista = Especialista::find($id);
        if(!$especialista){
            Alert::error('¡Error!', 'Registro no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        }

        return view('especialistas.edit')->with('especialista', $especialista);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate the request
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'email' => 'required|email|unique:especialistas,email,' . $id,
        'telefono' => 'required|string|max:15',
        'cedula' => 'nullable|string|max:20',
        'fecha_nacimiento' => 'required|date',
        'especialidad' => 'required|string|max:255',
        'nota' => 'nullable|string',
        'residencia' => 'nullable|string|max:255',
    ]);

    // Find the specialist and update the record
    $especialista = Especialista::findOrFail($id);
    $especialista->update($request->all());

    // Redirect or return response
    Alert::success('¡Éxito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

    return redirect()->route('especialistas.index')->with('success', 'Especialista actualizado exitosamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Step 1: Find the Representante record by its ID or fail with a 404 error
        $representante = Especialista::findOrFail($id);
        
        // Step 2: Delete the record
        $representante->delete();
    
        // Step 3: Redirect or return a response
        Alert::success('¡Éxito!', 'Registro eliminado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
    
        return redirect()->route('especialistas.index')->with('success', 'Representante eliminado correctamente.');
    }
}
