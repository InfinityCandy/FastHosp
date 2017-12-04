<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class administrarCitasEspecialidadController extends Controller
{
    public function listarCitasPendientes () {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        $expedienteMedico = Session::get('expediente');
        $expedienteMedicoSplit = explode("-", $expedienteMedico);
        
        if($userName != "") {
            $queryResult = DB::table('citas_especialidads')
                                ->join('pacientes', 'citas_especialidads.expedientePaciente', '=', 'pacientes.pacienteExpediente')
                                ->where('citas_especialidads.especialidadCanalizada', "=", $expedienteMedicoSplit[2])
                                ->select('pacientes.pacienteExpediente', 'pacientes.nombre', 'pacientes.apellido', 'pacientes.foto')
                                ->get(); 
            
            $medicoEspecialidad = DB::table('especialidads')
                                ->where('id', "=", $expedienteMedicoSplit[2])
                                ->select('especialidad')
                                ->get(); 
            
            return view ('medicoEspecialista.listadoCitas', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult, 'especialidad' => $medicoEspecialidad[0]->especialidad]);
        }
        else {
            return redirect('/');
        }
    }//Fin de listarCitasPendientes
    
    public function consulta ($expedientePaciente) {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        $expedienteMedico = Session::get('expediente');
        
        
        if($userName != "") {
            $queryResult = DB::table('historial_clinicos')
                                    ->join('pacientes', 'historial_clinicos.expedientePaciente', '=', 'pacientes.pacienteExpediente')
                                    ->where('historial_clinicos.expedientePaciente', "=", $expedientePaciente)
                                    ->select('pacientes.pacienteExpediente', 'pacientes.nombre', 'pacientes.apellido', 'pacientes.foto', 'pacientes.edad', 'pacientes.tipoDeSangre', 'pacientes.estadoCivil', 'pacientes.tipoDeAfiliacion', 'historial_clinicos.peso', 'historial_clinicos.altura', 'historial_clinicos.presionArterial', 'historial_clinicos.temperaturaCorporal', 'historial_clinicos.historiaClinica', 'historial_clinicos.alergiaAMedicamentos', 'historial_clinicos.adicciones', 'historial_clinicos.condiciones')
                                    ->get(); 
            $historiaClinicaExploded = explode('< br>', $queryResult[0]->historiaClinica);

            for($i = 0; $i < sizeof($historiaClinicaExploded); $i++) {
                $historiaClinicaExploded[$i] = explode('<br >', $historiaClinicaExploded[$i]);
            }


            return view('medicoEspecialista.consulta', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult[0],'expedienteMedico' => $expedienteMedico,'historiaClinica' => $historiaClinicaExploded]); 
        }
        else {
            return redirect('/');
        }
    }//Fin de consulta
}
