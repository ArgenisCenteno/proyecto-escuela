
 
    <table class="table table-bordered" id="notasmedicas-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cita</th>
                <th>Especialista</th>
                <th>Paciente</th>
                <th>Nota</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>


    @section('js')
@include('layout.script')
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#notasmedicas-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('notasmedicas.index') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'cita_id', name: 'cita_id' },
                { data: 'especialista', name: 'especialista' },
                { data: 'paciente', name: 'paciente' },
                { data: 'nota', name: 'nota' },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection