<?php

namespace App\Http\Controllers;

use App\Models\NotaMedica;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotaMedicaController extends Controller
{
    /**
     * Display a listing of the notas médicas.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $notasMedicas = NotaMedica::with(['cita', 'especialista'])->get();
            return DataTables::of($notasMedicas)
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('notasmedicas.edit', [$row->id]) . '" class="btn btn-info">Editar</a>
                            <form action="' . route('notasmedicas.destroy', [$row->id]) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar esta nota médica?\');">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d'); 
                })
                ->editColumn('paciente', function ($row) {
                    return $row->cita->paciente->nombre . ' ' . $row->cita->paciente->apellido; 
                })
                ->editColumn('especialista', function ($row) {
                    return $row->especialista->nombre . ' ' . $row->especialista->apellido; 
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('notasmedicas.index');
    }

    /**
     * Show the form for creating a new nota médica.
     */
    public function create()
    {
        return view('notasmedicas.create');
    }

    /**
     * Store a newly created nota médica in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cita_id' => 'required|integer',
            'especialista_id' => 'required|integer',
            'nota' => 'required|string'
        ]);

        NotaMedica::create($request->all());

        return redirect()->route('notasmedicas.index')->with('success', 'Nota médica creada exitosamente.');
    }

    /**
     * Show the form for editing the specified nota médica.
     */
    public function edit($id)
    {
        $notaMedica = NotaMedica::findOrFail($id);
        return view('notasmedicas.edit', compact('notaMedica'));
    }

    /**
     * Update the specified nota médica in storage.
     */
    public function update(Request $request, $id)
    {
        

        $notaMedica = NotaMedica::findOrFail($id);
        $notaMedica->update($request->all());

        return redirect()->route('notasmedicas.index')->with('success', 'Nota médica actualizada exitosamente.');
    }

    /**
     * Remove the specified nota médica from storage.
     */
    public function destroy($id)
    {
        $notaMedica = NotaMedica::findOrFail($id);
        $notaMedica->delete();

        return redirect()->route('notasmedicas.index')->with('success', 'Nota médica eliminada exitosamente.');
    }
}
