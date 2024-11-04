
    
    <table class="table table-bordered" id="paciente-tratamientos-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Tratamiento</th>
                <th>Especialista</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Observaciones</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>

@section('js')
@include('layout.script')
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
<script>
    $(function() {
        $('#paciente-tratamientos-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('pacienteTratamientos.index') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'paciente.nombre', name: 'paciente.nombre' },
                { data: 'tratamiento.nombre', name: 'tratamiento.nombre' },
                { data: 'especialista', name: 'especialista' },
                { data: 'fecha_inicio', name: 'fecha_inicio' },
                { data: 'fecha_fin', name: 'fecha_fin' },
                { data: 'observaciones', name: 'observaciones' },
                { data: 'estatus', name: 'estatus' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
