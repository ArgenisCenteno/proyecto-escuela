<div class="table-responsive">
    <table class="table table-hover" id="categorias-table">
        <thead class="bg-light">
            <tr >
                <th >#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Genero</th>
                <th>Discapacidad</th>
                <th>Representante</th>
                <th>Fecha de registro</th>
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
            ajax: "{{route('pacientes.index')}}",
            dataType: 'json',
            type: "POST",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nombre',
                    name: 'nombre',
                },
                {
                    data: 'apellido',
                    name: 'apellido',
                },
                {
                    data: 'genero',
                    name: 'genero',
                },
               
                {
                    data: 'discapacidad',
                    name: 'discapacidad',
                },
                {
                    data: 'representante',
                    name: 'representante',
                },

                {
                    data: 'fecha',
                    name: 'fecha',
                },


                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    orderable: false
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
