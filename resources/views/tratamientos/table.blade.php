

    <table class="table table-bordered" id="tratamientos-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Actualización</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>

    @include('layout.script')
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tratamientos-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tratamientos.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'nombre', name: 'nombre' },
                { data: 'descripcion', name: 'descripcion' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
</script>
