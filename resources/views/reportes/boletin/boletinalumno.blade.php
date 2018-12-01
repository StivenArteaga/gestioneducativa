<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boletin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="cssreportes/boletin/boletin.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="content">
        <div class="header">
            <div class="logo">
                <img src="img/logo-03.png" alt="Logo Institución">
            </div>
            <div class="txt_header">
                <h1 class="txt_header_colegio">COLEGIO NUEVA GENERACIÓN</h1>
                <h2 class="txt_header_place">Barranquilla 1930</h2>
                <h2 class="txt_header_title">INFORME DESCRIPTIVO DE FORTALEZAS, DEBILIDADES Y RECOMENDACIONES</h2>
            </div>
        </div>
        <div class="content_boletin">
            <div class="fila_1">
            <div class="year border">Año: {{ $año }} </div>
                <div class="jornada border">Jornada: {{ $respuesta->NombreJornada }}</div>
                <div class="grado border">Grado: Noveno</div>
                <div class="informe border">Informe: Segundo</div>
            </div>
            <div class="fila_2">
                <div class="estudiante border">Estudiante:Juliana Andrea Deantonio Castaño</div>
            </div>
            
            <div class="fila_3">
                <div class="asignatura border">AREAS/ASIGNATURAS</div>
                <div class="val border">VAL</div>
                <div class="p1 border">P1</div>
                <div class="p2 border">P2</div>
                <div class="p3 border">P3</div>
                <div class="p4 border">P4</div>
                <div class="aus border">AUS</div>
            </div>
            <!-- ASIGNATURA -->
            <div class="fila_4">
                <div class="asignatura2 border">CIENCIAS NATURALES Y EDUCACIÓN AMBIENTAL</div>
                <div class="val border">4.7</div>
                <div class="p1 border">3</div>
                <div class="p2 border">3.2</div>
                <div class="p3 border">2.9</div>
                <div class="p4 border">4.5</div>
                <div class="aus border">3</div>
            </div>
            <!-- MATERIA -->
            <div class="fila_4">
                    <div class="asignatura2 border">Ciencias naturales</div>
                    <div class="val border">4.7</div>
                    <div class="p1 border">3</div>
                    <div class="p2 border">3.2</div>
                    <div class="p3 border">2.9</div>
                    <div class="p4 border">4.5</div>
                    <div class="aus border">3</div>
                </div>
            <!-- LOGRO -->
            <div class="logros">
                <div id="logro" class="border">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus non amet, a explicabo veritatis natus fugiat exercitationem, dolor nemo quidem ducimus minima dolorem atque! Excepturi earum itaque enim tenetur tempora!</div>
            </div>
            <div class="firma">
                <h1><hr></h1>
                <h2>Nombre coordinador</h2>
                <h2>Cargo</h2>
            </div>
        </div>

    </div>
</body>
</html>