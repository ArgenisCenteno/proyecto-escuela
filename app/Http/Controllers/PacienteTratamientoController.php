<?php

namespace App\Http\Controllers;

use App\Exports\PacienteTratamientosExport;
use App\Models\PacienteTratamiento;
use App\Models\Paciente;
use App\Models\Tratamiento;
use App\Models\Especialista;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Alert;
class PacienteTratamientoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pacienteTratamientos = PacienteTratamiento::with(['paciente', 'tratamiento', 'especialista'])->get();
            return DataTables::of($pacienteTratamientos)
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('pacienteTratamientos.edit', $row->id) . '" class="btn btn-info">Editar</a>
                            <form action="' . route('pacienteTratamientos.destroy', $row->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'¿Está seguro de que desea eliminar este registro?\');">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>';
                })
                ->editColumn('estatus', function ($row) {
                    return '<span class="badge badge-' . ($row->estatus == 'Completado' ? 'success' : ($row->estatus == 'Cancelado' ? 'danger' : 'warning')) . '">' . ucfirst($row->estatus) . '</span>';
                })
              ->editColumn('especialista', function($row){
                if($row->especialista != null){
                    dd($row->especialista);
                    return $row->especialista->nombre . ' ' . $row->especialista->apellido;

                }else{
                    return 'S/N';

                }
              })
                ->rawColumns(['actions', 'estatus'])
                ->make(true);
        }

        return view('paciente_tratamientos.index');
    }

    public function create()
    {
        $pacientes = Paciente::all();
        $tratamientos = Tratamiento::all();
        $especialistas = Especialista::all();
        return view('paciente_tratamientos.create', compact('pacientes', 'tratamientos', 'especialistas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|integer',
            'tratamiento_id' => 'required|integer',
            'especialista_id' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'estatus' => 'required|string'
        ]);

        $consultar = PacienteTratamiento::where('paciente_id', $request->paciente_id)->where('estatus', 'En proceso')->first();
      //  dd($consultar);
        if($consultar){
            Alert::error('¡Error!', 'Para registrar un nuevo tratamiento a un paciente se debe finalizar el tratamiento anterior')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
            return redirect()->back();
        }

        PacienteTratamiento::create($request->all());
        Alert::success('¡Éxito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('pacienteTratamientos.index')->with('success', 'Tratamiento asignado exitosamente.');
    }

    public function edit($id)
    {
        $pacienteTratamiento = PacienteTratamiento::findOrFail($id);
        $pacientes = Paciente::all();
        $tratamientos = Tratamiento::all();
        $especialistas = Especialista::all();
        return view('paciente_tratamientos.edit', compact('pacienteTratamiento', 'pacientes', 'tratamientos', 'especialistas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente_id' => 'required|integer',
            'tratamiento_id' => 'required|integer',
            'especialista_id' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'estatus' => 'required|string'
        ]);

        $pacienteTratamiento = PacienteTratamiento::findOrFail($id);
        $pacienteTratamiento->update($request->all());
        Alert::success('¡Éxito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('pacienteTratamientos.index')->with('success', 'Tratamiento actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $pacienteTratamiento = PacienteTratamiento::findOrFail($id);
        $pacienteTratamiento->delete();
        Alert::success('¡Éxito!', 'Registro eliminado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');
        return redirect()->route('pacienteTratamientos.index')->with('success', 'Tratamiento eliminado exitosamente.');
    }

    public function export(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        return Excel::download(new PacienteTratamientosExport($request->fecha_inicio, $request->fecha_fin), 'paciente_tratamientos.xlsx');
    }
}
