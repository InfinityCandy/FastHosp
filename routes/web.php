<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'IndexController@index');
Route::post('login', 'IndexController@login');

Route::get('test', 'IndexController@test');

//Administrativo General Routes
Route::get('administrativoGeneral', 'administrativoGeneralMainController@index');
Route::get('admonGeneralCambiarPassword', 'administrativoGeneralMainController@cambiarPasswordForm');
Route::post('admonGeneralCambiarPassword', 'administrativoGeneralMainController@cambiarPasswordPost');
Route::get('administrativoGeneralLogout', 'administrativoGeneralMainController@logout');
Route::resource('administrarAdministrativos', 'administrarAdministrativosController');
Route::resource('administrarPacientes', 'administrarPacientesController');
Route::resource('administrarMedicos', 'administrarMedicosController');
Route::resource('administrarUrgenciologos', 'administrarUrgenciologosController');
Route::resource('administrarFarmaceuticos', 'administrarFarmaceuticosController');

//Administrativo Familiar Routes
Route::get('administrativoFamiliar', 'administrativoFamiliarMainController@index');
Route::get('admonFamiliarCambiarPassword', 'administrativoFamiliarMainController@cambiarPasswordForm');
Route::post('admonFamiliarCambiarPassword', 'administrativoFamiliarMainController@cambiarPasswordPost');
Route::get('administrativoFamiliarLogout', 'administrativoFamiliarMainController@logout');
Route::resource('agregarCita', 'agregarCitasController');
//Helpers para Administrativo familiar
Route::get('obtenerNombreDePaciente/{expediente}', 'ajaxHelper@obtenerNombreDePaciente');
Route::get('obtenerMedicoAsignado', 'ajaxHelper@obtenerExpedienteMedicoAsignado');

//Administrativo Urgencias Routes
Route::get('administrativoUrgencias', 'administrativoUrgenciasMainController@index');
Route::get('admonUrgenciasCambiarPassword', 'administrativoUrgenciasMainController@cambiarPasswordForm');
Route::post('admonUrgenciasCambiarPassword', 'administrativoUrgenciasMainController@cambiarPasswordPost');
Route::get('administrativoUrgenciasLogout', 'administrativoUrgenciasMainController@logout');
Route::resource('agregarCitaUrgencias', 'agregarCitasDeUrgenciasController');
//Helpers para Administrativo urgencias
Route::get('obtenerDatosDeUrgencia', 'ajaxHelper@obtenerDatosDeUrgencia');

//Medico Familiar Routes
Route::get('medicoFamiliar', 'medicoFamiliarMainController@index');
Route::get('medicoFamiliarCambiarPassword', 'medicoFamiliarMainController@cambiarPasswordForm');
Route::post('medicoFamiliarCambiarPassword', 'medicoFamiliarMainController@cambiarPasswordPost');
Route::get('medicoFamiliarLogout', 'medicoFamiliarMainController@logout');
Route::get('listarCitasPendientes', 'administrarCitasMedicinaFamiliarController@listarCitasPendientes');
Route::get('consulta/{expedientePaciente}', 'administrarCitasMedicinaFamiliarController@consulta');
Route::post('finalizarConsulta', 'administrarCitasMedicinaFamiliarController@finalizarConsulta');

//Medico Especialista Routes
Route::get('medicoEspecialista', 'medicoEspecialistaMainController@index');
Route::get('medicoEspecialistaCambiarPassword', 'medicoEspecialistaMainController@cambiarPasswordForm');
Route::post('medicoEspecialistaCambiarPassword', 'medicoEspecialistaMainController@cambiarPasswordPost');
Route::get('medicoEspecialistaLogout', 'medicoEspecialistaMainController@logout');
Route::get('listarCitasPendientesEspecialidad', 'administrarCitasEspecialidadController@listarCitasPendientes');
Route::get('consultaEspecialidad/{expedientePaciente}', 'administrarCitasEspecialidadController@consulta');

//Urgenciologos Routes
Route::get('urgenciologo', 'urgenciologoMainController@index');
Route::get('urgenciologoCambiarPassword', 'urgenciologoMainController@cambiarPasswordForm');
Route::post('urgenciologoCambiarPassword', 'urgenciologoMainController@cambiarPasswordPost');
Route::get('urgenciologoLogout', 'urgenciologoMainController@logout');
Route::get('listarCitasPendientesUrgencias', 'administrarCitasUrgencias@listarCitasPendientes');
Route::get('consultaUrgencias/{expedientePaciente}', 'administrarCitasUrgencias@consulta');
Route::post('finalizarConsultaUrgencias', 'administrarCitasUrgencias@finalizarConsulta');

//Farmaceuticos Routes
Route::get('farmaceutico', 'farmaceuticoMainController@index');
Route::get('farmaceuticoCambiarPassword', 'farmaceuticoMainController@cambiarPasswordForm');
Route::post('farmaceuticoCambiarPassword', 'farmaceuticoMainController@cambiarPasswordPost');
Route::get('farmaceuticoLogout', 'farmaceuticoMainController@logout');
Route::get('listarPeticionesEnFarmacia', 'administrarRecetasDeFarmacosController@listarPeticionesEnFarmacia');
Route::get('verPeticionDeFarmacia/{expedientePaciente}', 'administrarRecetasDeFarmacosController@iniciarDespachoDeFarmacos');
Route::post('despacharPeticionDeFarmacia', 'administrarRecetasDeFarmacosController@despacharPeticionDeFarmaco');

