<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cédula Estudiantil - CDI "Luisa Cáceres de Arismendi</title>

    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            font-size: 12px;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 70px;
            height: auto;
        }

        .container {
            border: 1px solid #000;
            padding: 15px;
            width: 500px;
            margin: 0 auto;
            background-color: #f9f9f9;
        }

        .foto {
            border: 1px solid #000;
            width: 100px;
            height: 120px;
            margin-bottom: 10px;
        }

        .datos p {
            margin: 5px 0;
            line-height: 1.4;
        }

        .titulo {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header text-center">
            <p style="margin: 0; font-size: 10px; font-weight: bold;">REPÚBLICA BOLÍVARIANA DE VENEZUELA</p>
            <p style="margin: 0; font-size: 10px; font-weight: bold;">ESTADO MONAGAS</p>
            <p style="margin: 0; font-size: 10px; font-weight: bold;">CDI "Luisa Cáceres de Arismendi"</p>
        </div>

        <div class="text-center mt-2">
            <h1 class="titulo">CÉDULA ESTUDIANTIL</h1>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="foto" style="width: 100px; height: 120px; border: 1px solid #000;">
                <!-- Espacio reservado para la foto -->
            </div>
            <div class="text-center">
                <p><strong>Número:</strong> {{ $paciente->created_at->format('Ymd') . $paciente->id }}</p>
            </div>
        </div>

        <div class="datos mt-3">
            <p><strong>Nombre:</strong> {{ strtoupper($paciente->nombre . ' ' . $paciente->apellido) }}</p>
            <p><strong>Cédula:</strong> {{ $paciente->cedula ?? 'N/A' }}</p>
            <p><strong>Representante:</strong> 
                {{ $paciente->representante ? strtoupper($paciente->representante->nombre . ' ' . $paciente->representante->apellido) : 'N/A' }}
            </p>
            <p><strong>Dirección:</strong> 
                {{ $paciente->representante && $paciente->representante->residencia ? strtoupper($paciente->representante->residencia) : 'N/A' }}
            </p>
            <p><strong>Fecha de Inscripción:</strong> {{ $paciente->created_at->format('d/m/Y') }}</p>
            <p><strong>Última Actualización:</strong> {{ $paciente->updated_at->format('d/m/Y') }}</p>
        </div>

        <div class="footer text-center mt-3">
            <p style="margin: 0; font-size: 10px;">Emitida por la CDI "Luisa Cáceres de Arismendi"</p>
        </div>
    </div>

</body>


</html>
