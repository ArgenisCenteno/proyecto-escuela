<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDI Luisa Caceres de Arismendi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        body {
            font-family: "Poppins" !important;
        }

        /* Container */
        .card-container {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background: white;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .card-header .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header .header-left,
        .card-header .header-right {
            text-align: center;
        }

        .title {
            font-size: 23px;
            text-align: center !important;
            margin: 0;
            color: #19306e;
            font-weight: bold;
        }

        .title2 {
            font-size: 16px;
            margin: 0;
            color: black;

        }

        /* Info Section */
        .info-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .info-left {
            flex: 0 0 150px;

        }

        .foto-estudiantes {
            border-radius: 50% !important;
            width: 300px !important;
            height: 300px !important;
        }

        .info-right {
            flex: 1;
            padding-left: 20px;
        }

        .info-right p {
            margin: 5px 0;
            font-size: 16px;
            color: #19306e !important;
            z-index: 999;
        }



        .logo {
            width: 150px;
        }

        .banner {
            position: relative;
            display: inline-flex;
            /* Cambiado a flexbox */
            justify-content: center;
            justify-content: center;
            /* Alinea el texto horizontalmente */
            align-items: center;
            /* Alinea el texto verticalmente */
            /* Alinea el texto horizontalmente */

            width: 220px;
            /* Ancho del banner */
            height: 90px;
            /* Alto del banner */
            background: #daa520;
            /* Fondo dorado */

            /* Color del texto */
            font-weight: bold;
            font-size: 20px;
            /* Tamaño del texto */
            text-align: center;
        }

        .banner:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 45px 0 45px 45px;
            /* Tamaño del triángulo */
            border-color: transparent transparent transparent white;
            /* Color del triángulo */
        }

        * {
            font-family: Arial, sans-serif;
        }

     

     

        /* Agregar las estrellas (si se desean) */
    </style>
</head>

<body>
    <div class="card-container">
        <div class="card-header">
            <table class="table table-borderless p-0 m-0">
                <thead>
                    <tr class="">
                        <td class=" text-left">
                            <img src="{{public_path('iconos/logo.jpg')}}" class="logo" alt="Foto">


                        </td>
                        <td class=" text-left">
                            <div class="header-left">
                                <p class="bold title text-info">CENTRO DE DESARROLLO INFANTIL</p>
                                <p class="bold title2 text-info">"LUISA CÁCERES DE ARISMENDI"</p>
                            </div>

                        </td>
                        <td></td>

                        <td></td>

                        <td class="title">
                            <div>
                                <h4>CARNET ESTUDIANTIL</h>
                            </div>
                        </td>
                    </tr>

                </thead>
            </table>
        </div>

        <hr class="venezuela-flag"
            style="height: 10px; border: none; background-color: #FFD700; margin-top: 40px !important;" />
        <hr class="venezuela-flag" style="height: 10px; border: none; background-color: #0033A0;" />
        <hr class="venezuela-flag"
            style="height: 10px; border: none; background-color: #D52B1E; margin-bottom: 40px !important;" />

        <div class="info-section">
            <table class="table table-borderless p-0 m-0">
                <thead>
                    <tr class="">
                        <td></td>
                        <td></td>
                        <td class="info-left">
                            <img src="{{public_path('iconos/estudiantes.jpeg')}}" class="foto-estudiantes" alt="Foto">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>




                        <td class=" info-right left">

                            <p class="p-4 m-4"><strong>ID:</strong>
                                {{ $paciente->created_at->format('Ymd') . $paciente->id }}</p>
                            <br>
                            <p class="p-4 m-4"><strong>NOMBRE:</strong>
                                {{ strtoupper($paciente->nombre . ' ' . $paciente->apellido) }}</p>
                            <br>
                            <p class="p-4 m-4"><strong>FECHA NACIMIENTO:</strong>
                                {{ $paciente->fecha_nacimiento ?? '' }} </p>
                            <br>
                            <p class="p-4 m-4"><strong>REPRESENTANTE:</strong>
                                {{ $paciente->representante ? strtoupper($paciente->representante->nombre . ' ' . $paciente->representante->apellido) : 'N/A' }}
                            </p>
                            <br>
                            <p class="p-4 m-4"><strong>DIRECCIÓN:</strong>
                                {{ $paciente->representante && $paciente->representante->residencia ? strtoupper($paciente->representante->residencia) : 'N/A' }}
                            </p>


                        </td>
                        <td ></td>


                    </tr>

                </thead>
            </table>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>