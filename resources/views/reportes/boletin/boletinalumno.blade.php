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
                <div class="jornada border">Jornada: {{ $cuerpo->NombreJornada }}</div>
            <div class="grado border">Grado: {{ $cuerpo->Grado }}</div>
            <div class="informe border">Informe: {{ $cuerpo->Periodo }}</div>
            </div>
            <div class="fila_2">
                @if($cuerpo->SegundoNombreAlumno == null)
                    <div class="estudiante border">Estudiante:{{ $cuerpo->PrimerNombreAlumno.' '. $cuerpo->PrimerApellidoAlumno.' '.$cuerpo->SegundoApellidoAlumno }}</div>                    
                @else
                    <div class="estudiante border">Estudiante:{{ $cuerpo->PrimerNombreAlumno.' '.$cuerpo->SegundoNombreAlumno.' '. $cuerpo->PrimerApellidoAlumno.' '.$cuerpo->SegundoApellidoAlumno }}</div>
                @endif
            </div>
            
            <div class="fila_3">
                <div class="asignatura border">MATERIAS/ASIGNATURAS</div>                
                <div class="p1 border">P1</div>
                <div class="p2 border">P2</div>
                <div class="p3 border">P3</div>
                <div class="p4 border">P4</div>
                <div class="aus border">AUS</div>
            </div>
            @foreach ($seleccionado as $item)
                 <!-- ASIGNATURA -->
            <div class="fila_4">
                    <div class="asignatura2 border">{{ strtoupper($item->NombreMateria) }}</div>                    
                    <div class="p1 border">3</div>
                    <div class="p2 border">3.2</div>
                    <div class="p3 border">2.9</div>
                    <div class="p4 border">4.5</div>
                    <div class="aus border">3</div>
                </div>
                <!-- MATERIA -->
                <div class="fila_4">
                        <div class="asignatura2 border">{{ strtoupper($item->NombreAsignatura) }}</div>                        
                        <div class="p1 border">3</div>
                        <div class="p2 border">3.2</div>
                        <div class="p3 border">2.9</div>
                        <div class="p4 border">4.5</div>
                        <div class="aus border">3</div>
                    </div>
                <!-- LOGRO -->
                <div class="logros">
                    <div id="logro" class="border">{{ $item->DescripcionLogro }}</div>
                </div>
            @endforeach           
            <div class="firma">
                <h1><hr></h1>
                @if ($cuerpo->SegundoNombreCoordinador == null)
                    <h2>{{ strtoupper($cuerpo->PrimerNombreCoordinador.' '.$cuerpo->PrimerApellidoCoordinador.' '.$cuerpo->SegundoApellidoCoordinador) }}</h2>
                @else
                <h2>{{ strtoupper($cuerpo->PrimerNombreCoordinador.' '.$cuerpo->SegundoNombreCoordinador.' '.$cuerpo->PrimerApellidoCoordinador.' '.$cuerpo->SegundoApellidoCoordinador) }}</h2>
                @endif                
                <h2>Coordinador</h2>
            </div>
        </div>

    </div>
</body>
</html>