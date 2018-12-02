<?php

Route::get('/','Auth\LoginController@showLoginForm'); 
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function() {


    Route::get('main','DashboardController@index')->name('main');

    Route::get('cons','ConstruccionController@index')->name('cons');



    Route::get('maestros','MaestroController@index')->name('maestros');

    Route::get('updmae/updmae/{id}', 'MaestroController@edit');

    Route::resource('maestro', 'MaestroController');



    Route::get('alumnos', 'AlumnoController@index')->name('alumno');
    Route::get('/alumnos/ciudades/{id}', 'AlumnoController@getCiudad');
    Route::get('/alumnos/municipios/{id}', 'AlumnoController@getMunicipio');

    Route::get('editalum/editalum/{id}', 'AlumnoController@edit');

    Route::get('autoincre/', 'AlumnoController@autoincre');

    Route::get('listalum/{id}', 'AlumnoController@listalum');

    Route::get('guardalum/{request}', 'AlumnoController@store');

    Route::post('update/update/{request}/{id}', 'AlumnoContoller@update');

    Route::resource('alumno','AlumnoController');





    Route::get('areas', 'AreaController@index')->name('areas');

    Route::get('edit/edit/{id}', 'AreaController@edit');

    Route::get('detallarea/{id}', 'AreaController@show');

    Route::resource('area', 'AreaController');



    Route::get('materia','MateriaController@index')->name('materia');

    Route::get('updmat/updmat/{id}', 'MateriaController@edit');

    Route::get('detallemat/{id}', 'MateriaController@show');

    Route::resource('materias', 'MateriaController');



    Route::get('asignaturas', 'AsignaturaController@index')->name('asignaturas');

    Route::get('updasi/updasi/{id}', 'AsignaturaController@edit');

    Route::get('detalleasig/{id}', 'AsignaturaController@show');

    Route::resource('asignatura', 'AsignaturaController');


    Route::get('logros', 'LogroController@index')->name('logros');

    Route::get('updlog/updlog/{id}', 'LogroController@edit');

    Route::resource('logro', 'LogroController');



    Route::get('jornadas', 'JornadaController@index')->name('jornadas');

    Route::get('uptjor/uptjor/{id}', 'JornadaController@edit');

    Route::resource('jornada', 'JornadaController');



    Route::get('grados', 'GradoController@index')->name('grados');

    Route::get('updgra/updgra/{id}', 'GradoController@edit');

    Route::resource('grado', 'GradoController');



    Route::get('aulas', 'SalonController@index')->name('aulas');

    Route::get('updaul/updaul/{id}', 'SalonController@edit');

    Route::resource('aula', 'SalonController');



    Route::get('grupos', 'GrupoController@index')->name('grupos');

    Route::get('updgrup/updgrup/{id}', 'GrupoController@edit');

    Route::get('listalum/listalum/{id}', 'GrupoController@listalum');

    Route::post('grupstor/grupstor/{request}', 'GrupoController@store');

    Route::resource('grupo', 'GrupoController');



    Route::get('matriculas', 'MatriculaController@index')->name('matriculas');

    Route::get('updmatr/updmatr/{id}', 'MatriculaController@edit');

    Route::get('lismat/lismat/{id}', 'MatriculaController@listmat');

    Route::resource('matricula', 'MatriculaController');




    Route::get('sedes', 'SedeController@index')->name('sedes');

    Route::get('updsed/updsed/{id}', 'SedeController@edit');

    Route::resource('sede', 'SedeController');


        
    Route::get('evaluaciones', 'EvaluacionController@index')->name('evaluaciones');

    Route::get('listasig/listasig/{id}', 'EvaluacionController@listasig');

    Route::get('listalumasig/listalumasig/{id}/{idasig}', 'EvaluacionController@listalumasig');

    Route::get('evalalum/evalalum/{id}', 'EvaluacionController@evalalum');

    Route::get('listalog/listalog/{id}/{idalumno}/{periodo}', 'EvaluacionController@listalog');

    Route::get('savelog/savelog/{resquest}/{id}', 'EvaluacionController@savelog');



    Route::get('tgrupos', 'TipoGrupoController@index')->name('tgrupos');

    Route::get('updtipgrup/updtipgrup/{id}', 'TipoGrupoController@updtipgrup');

    Route::resource('tgrupo', 'TipoGrupoController');


    Route::get('observador', 'ObservadorController@index');
    Route::get('observador/notas/{id}','ObservadorController@cargarTablaNotas');

    Route::get('calificaciones', 'CalificacionController@index')->name('calificaciones');
    Route::get('editcalificacion/{id}','CalificacionController@edit');
    Route::resource('calificacion', 'CalificacionController');

    Route::get('observaciones', 'ObservadorController@observaciones');
    Route::get('observaciones/create', 'ObservadorController@create');
    Route::post('observaciones/store', 'ObservadorController@store');
    Route::get('observaciones/{id}/edit', 'ObservadorController@edit');
    Route::post('observaciones/update/{id}', 'ObservadorController@update');

    /*Reportes */
    Route::get('BoletinAlumno/{Id}/{ida}/{periodo}', 'ReporteController@BoletinAlumno');
    Route::resource('boletin','ReporteController');

    //Inasistencia
    Route::get('inasistencias','InasistenciaController@index')->name('inasistencias');
    Route::get('inasistencia/grupo/{Id}', 'InasistenciaController@grupos');
    Route::get('inasistencia/grado/{Id}/{IdA}','InasistenciaController@alumnos');
    Route::get('inasistenciasalumnos/{asignatura}/{alumno}','InasistenciaController@add');
    Route::resource('inasistencia','InasistenciaController');

    Route::get('secretarias','SecretariaController@index')->name('secretarias');
    Route::get('secretaria/{id}/edit', 'SecretariaController@edit');
    Route::resource('secretaria','SecretariaController');
     /**
      * Coordinador
      */
      Route::resource('coordinadores', 'CoordinadorController');


});











