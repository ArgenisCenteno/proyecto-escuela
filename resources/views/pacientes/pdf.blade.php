<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UPTNMLS</title>

    <link rel="stylesheet" href="{{ public_path('css/pdfAENe.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after:
                'auto' 
            ;
        }
    </style>
</head>

<body>

    <header class="row">
        <div class="header-left">

        </div>
        <div class="header-center text-center fw-bold">
            <strong>
                <p style="margin-top: 0; margin-bottom:0; font-size:0.8rem;">REPÚBLICA BOLÍVARIANA DE VENEZUELA</p>
                <p style="margin-top: 0; margin-bottom:0; font-size:0.8rem;">ESTADO MONAGAS</p>
                <p style="margin-top: 0; margin-bottom:0; font-size:0.8rem;">Punta de Mata
                </p>
            </strong>
        </div>
        <div class="header-right">

        </div>
    </header>

    <div class="fondo-titulo text-center container-fluid">
        <h1><strong>REGISTRO DE ALUMNO</strong></h1>
    </div>

    <div style="clear: both;"></div>

    <div class="container content-doc mt-2">
        <div class="col-6 d-inline-flex">
            <p class="mb-0 mt-1 " style="font-size: 12px;"><strong>NOMBRE</strong></p>
            <p class="razon-social mb-0 p-1 pl-3" style="font-size: 12px; padding-left: 10px;">
                {{ strtoupper($paciente->nombre . ' ' . $paciente->apellido) }}
            </p>
        </div>

        <div class="col-4 d-inline-flex ">
            <br>

            <p style="font-size: 12px;" class="licenciaE mb-0 p-1 pl-3 text-center"><strong>ID: </strong>
                @if ($paciente->id)
                    {{$paciente->id}}
                @else
                    {{'N' . $paciente->id }}

                @endif
            </p>
        </div>


        <div class="col-6 d-inline-flex mt-0">
            <p style="font-size: 12px;" class="mb-1 mt-0"><strong>CÉDULA:</strong> {{ $paciente->cedula ?? '' }}
            </p>
        </div>



        <div class="col-6 d-inline-flex">
            <p style="font-size: 12px;" class="mb-0"><strong>Representante:</strong></p>
            @if ($paciente->representante)
                <p style="font-size: 12px;">
                    {{ strtoupper($paciente->representante->nombre . ' ' . $paciente->representante->apellido) }}</p>

            @endif
        </div>
        <div class="col-6 d-inline-flex">
            <p style="font-size: 12px;" class="mb-0"><strong>Cédula del Representante:</strong></p>
            @if ($paciente->representante)
                <p style="font-size: 12px;">
                    {{ strtoupper($paciente->representante->cedula) }}</p>

            @endif
        </div>

        <div class="col-4 d-inline-flex">
            <p style="font-size: 12px;" class="mb-0"><strong>FECHA DE INSCRIPCIÓN:</strong></p>
            <p style="font-size: 12px;">{{ $paciente->created_at }}</p>
        </div>

        <div class="col-6 d-inline-flex">
            <p style="font-size: 12px;" class="mb-0"><strong>DIRECCIÓN:</strong></p>
            <p style="font-size: 12px;">{{ strtoupper($paciente->representante->residencia) }}</p>
        </div>

        <div class="col-4 d-inline-flex">
            <p style="font-size: 12px;" class="mb-0"><strong>Última Actualización:</strong></p>
            <p style="font-size: 12px;">{{ $paciente->updated_at }}</p>
        </div>



        <div class="col-4 d-inline-flex">


            <div class="col-4 d-inline-flex">
                <p style="font-size: 12px;" class="mb-0"></p>
                <p style="font-size: 12px;">

                </p>
            </div>
        </div>
        <div class=" text-center container-fluid">
        <h5><strong>CITAS</strong></h5>
    </div>
        <div class="container">
       
            <table class="table" style="font-size: 12px">
                <thead class="text-white" style="background-color: #1f3b73 !important">
                    <tr>
                        <th class="text-center" scope="col">CITA</th>
                        <th class="text-center" scope="col">ESTADO</th>
                        <th class="text-center" scope="col">DOCENTE</th>
                        <th class="text-center" scope="col">ASISTENCIA</th>
                        <th class="text-center" scope="col">FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td class="text-center">{{ $cita->id }}</td>
                            <td class="text-center">{{ strtoupper($cita->estatus) }}</td>
                            <td class="text-center">
                                {{ strtoupper($cita->especialista->nombre . ' ' . $cita->especialista->apellido) }}</td>
                            <td class="text-center">{{strtoupper( $cita->asistencia ? 'Asistio' : 'No Asistio' )}}</td>
                            <td class="text-center">{{ $cita->fecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center container-fluid">
        
    </div>
        


</body>

</html>