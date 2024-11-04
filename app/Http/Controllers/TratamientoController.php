<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Alert;
class TratamientoController extends Controller
{  
    /**
     * Display a listing of the tratamientos.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tratamientos = Tratamiento::get();
    
            return DataTables::of($tratamientos)
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('tratamientos.edit', [$row->id]) . '" class="btn btn-info"><span>Editar</span></a>
                            <form action="' . route('tratamientos.destroy', [$row->id]) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar este registro?\');">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-delete"><span>Eliminar</span></button>
                            </form>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->format('Y-m-d');
                })
                ->rawColumns(['actions'])
                ->make(true);
        } else {
            return view('tratamientos.index');
        }
    }

    /**
     * Show the form for creating a new tratamiento.
     */
    public function create()
    {
        return view('tratamientos.create');
    }

    /**
     * Store a newly created tratamiento in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $consultar = Tratamiento::where('nombre', $request->nombre)->first();

        if($consultar){
            Alert::error('¡Error!', 'Ya existe un tratamiento con este nombre')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->back();
        }

        Tratamiento::create($request->only('nombre', 'descripcion'));
        Alert::success('¡Exito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento creado exitosamente.');
    }

    /**
     * Display the specified tratamiento.
     */
    public function show(Tratamiento $tratamiento)
    {
        return view('tratamientos.show', compact('tratamiento'));
    }

    /**
     * Show the form for editing the specified tratamiento.
     */
    public function edit(Tratamiento $tratamiento)
    {
        return view('tratamientos.edit', compact('tratamiento'));
    }

    /**
     * Update the specified tratamiento in storage.
     */
    public function update(Request $request, Tratamiento $tratamiento)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tratamiento->update($request->only('nombre', 'descripcion'));
        Alert::success('¡Exito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento actualizado exitosamente.');
    }

    /**
     * Remove the specified tratamiento from storage.
     */
    public function destroy(Tratamiento $tratamiento)
    {
        $tratamiento->delete();
        Alert::success('¡Exito!', 'Registro eliminado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('tratamientos.index')->with('success', 'Tratamiento eliminado exitosamente.');
    }
}
