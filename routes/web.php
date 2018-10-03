<?php

Route::get('/','Auth\LoginController@showLoginForm'); 

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('main','DashboardController@index')->name('main');

Route::get('cons','ConstruccionController@index')->name('cons');



Route::get('maestros','MaestroController@index')->name('maestros');

Route::get('updmae/updmae/{id}', 'MaestroController@edit');

Route::resource('maestro', 'MaestroController');




Route::get('alumnos', 'AlumnoController@index')->name('alumno');

Route::get('editalum/editalum/{id}', 'AlumnoController@edit');

Route::get('autoincre/', 'AlumnoController@autoincre');

Route::get('listalum/{id}', 'AlumnoController@listalum');

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





