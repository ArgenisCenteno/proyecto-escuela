<div class="table-responsive">
    <table class="table table-hover" id="categorias-table">
        <thead class="bg-light">
            <tr >
                <th >#</th>
                <th>Paciente</th>
                <th>Especialista</th>
                <th>Representante</th>
                <th>Estado</th>
                <th>Fecha de cita</th>
                <th>Hora</th>
                <th>Asistencia</th>
                <th>Fecha de creación</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody class="text-center">

        </tbody>
    </table>


</div>

@section('js')
@include('layout.script')
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#categorias-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{route('citas.index')}}", // Update this route to point to the correct endpoint for fetching citas
        dataType: 'json',
        type: "POST",
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'paciente', // Assuming paciente relationship has 'nombre'
                name: 'paciente',
            },
            {
                data: 'especialista', // Assuming especialista relationship has 'nombre'
                name: 'especialista',
            },
            {
                data: 'representante', // Assuming representante relationship has 'nombre'
                name: 'representante',
            },
            {
                data: 'estatus', // Assuming estatus is a column in citas table
                name: 'estatus',
            },
            {
                data: 'fecha', // Assuming fecha is a column in citas table
                name: 'fecha',
            },
            {
                data: 'hora', // Assuming hora is a column in citas table
                name: 'hora',
            },
            {
                data: 'asistencia', // Assuming hora is a column in citas table
                name: 'asistencia',
            },
            {
                data: 'fecha_creacion', // Assuming created_at is a column in citas table
                name: 'fecha_creacion',
            },
            {
                data: 'actions', // Assuming actions will handle options like edit/delete
                name: 'actions',
                searchable: false,
                orderable: false,
            }
        ],
        order: [
            [0, 'desc']
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registro por Página",
            "zeroRecords": "Sin resultado",
            "info": "",
            "infoEmpty": "No hay Registros Disponibles",
            "infoFiltered": "filtrado _TOTAL_ de _MAX_ Registros Totales",
            "search": "Buscar",
            "paginate": {
                "next": ">",
                "previous": "<"
            }
        }
    });

    // Usar la delegación de eventos para los botones de eliminar
});
</script>


@endsection
