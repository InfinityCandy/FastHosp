<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class administrarCitasUrgencias extends Controller
{
    public function listarCitasPendientes () {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        $expedienteUrgenciologo = Session::get('expediente');
        
        if($userName != "") {
            $queryResult = DB::table('cita_urgencias')
                                ->join('pacientes', 'cita_urgencias.expedientePaciente', '=', 'pacientes.pacienteExpediente')
                                ->where('cita_urgencias.expedienteUrgenciologo', "=", $expedienteUrgenciologo)
                                ->select('pacientes.pacienteExpediente', 'pacientes.nombre', 'pacientes.apellido', 'pacientes.foto', 'cita_urgencias.turno')
                                ->get(); 

            return view ('urgenciologo.listadoCitas', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult]);
        }
        else {
            return redirect('/');
        }
    }//Fin de listarCitasPendientes
    
    public function consulta ($expedientePaciente) {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        $expedienteUrgenciologo = Session::get('expediente');
        
        
        if($userName != "") {
            $time = time();
            date_default_timezone_set('America/Mexico_City');
            $horaDeConsulta =  date('H:i:s', $time);
            
            $queryResult = DB::table('historial_clinicos')
                                    ->join('pacientes', 'historial_clinicos.expedientePaciente', '=', 'pacientes.pacienteExpediente')
                                    ->where('historial_clinicos.expedientePaciente', "=", $expedientePaciente)
                                    ->select('pacientes.pacienteExpediente', 'pacientes.nombre', 'pacientes.apellido', 'pacientes.foto', 'pacientes.edad', 'pacientes.tipoDeSangre', 'pacientes.estadoCivil', 'pacientes.tipoDeAfiliacion', 'historial_clinicos.peso', 'historial_clinicos.altura', 'historial_clinicos.presionArterial', 'historial_clinicos.temperaturaCorporal', 'historial_clinicos.historiaClinica', 'historial_clinicos.alergiaAMedicamentos', 'historial_clinicos.adicciones', 'historial_clinicos.condiciones')
                                    ->get(); 
            $historiaClinicaExploded = explode('< br>', $queryResult[0]->historiaClinica);

            for($i = 0; $i < sizeof($historiaClinicaExploded); $i++) {
                $historiaClinicaExploded[$i] = explode('<br >', $historiaClinicaExploded[$i]);
            }


            return view('urgenciologo.consulta', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult[0],'expedienteMedico' => $expedienteUrgenciologo,'historiaClinica' => $historiaClinicaExploded, 'horaDeConsulta' => $horaDeConsulta]); 
        }
        else {
            return redirect('/');
        }
    }//Fin de consulta
    
    public function finalizarConsulta (Request $request) {
        $historiaClinicaDelPaciente = DB::table('historial_clinicos')
                                      ->where('expedientePaciente', '=', $request->expedientePaciente) 
                                      ->select('historiaClinica')
                                      ->get();
        $time = time();
        date_default_timezone_set('America/Mexico_City');
        $horaDeConsultaFinalizada =  date('H:i:s', $time);
        
        $tiempoFinalDeConsulta = $this->calcularTiempoDeConsulta($horaDeConsultaFinalizada, $request->horaDeConsulta);
       
        DB::table('historico_tiempo_de_consultas')->insert(
            ['duracionDeConsulta' => $tiempoFinalDeConsulta,
             'expedienteUrgenciologo' => $request->expedienteMedico,  
            ]
        );
        
        if($request->medicamentosIndicados != "") {
            DB::table('medicamentos')->insert(
                ['expedienteDelPaciente' => $request->expedientePaciente,
                 'medicamentos' => $request->medicamentosIndicados,  
                ]
            );
        }
        
        DB::table('historial_clinicos')
            ->where('expedientePaciente', $request->expedientePaciente)
            ->update(
            ['peso' => $request->peso,
             'altura' => $request->altura,
             'presionArterial' => $request->presion,
             'temperaturaCorporal' => $request->temperaturaCorporal,
             'historiaClinica' => $historiaClinicaDelPaciente[0]->historiaClinica."Fecha de consulta: ".$request->fechaDeConsulta."<br >".$request->razonDeConsulta."<br >".$request->diagnosticoMedico."<br > Se le indicó al paciente: ".$request->indicaciones."<br > Se le recetó al paciente: ".$request->medicamentosIndicados."<br > < br> <br >",
             'alergiaAMedicamentos' => $request->alergiaAMedicamentos,
             'adicciones' => $request->adicciones,
             'condiciones' => $request->condiciones,    
            ]
        );
        
        DB::table('cita_urgencias')
            ->where('expedientePaciente', '=', $request->expedientePaciente)->delete();
        
        return redirect('listarCitasPendientesUrgencias');
    }//Fin de finalizarConsulta
    
    public function calcularTiempoDeConsulta ($horaDeConsultaFinalizada, $horaDeConsulta) {
        $horaDeConsultaFinalizadaSplit = explode(":", $horaDeConsultaFinalizada);
        $horaDeConsultaSplit = explode(":", $horaDeConsulta);
        
        for($i = 0; $i < sizeof($horaDeConsultaFinalizadaSplit); $i++) {
            if((int)$horaDeConsultaFinalizadaSplit[$i] >= (int)$horaDeConsultaSplit[$i]) {
                $horaDeConsultaFinalizadaSplit[$i] = (int)$horaDeConsultaFinalizadaSplit[$i] - (int)$horaDeConsultaSplit[$i];
            }
            else {
                $horaDeConsultaFinalizadaSplit[$i] = 0; 
            }
        }
        
        if($horaDeConsultaFinalizadaSplit[2] < 10) {
           $horaDeConsultaFinalizadaSplit[2] = "0"."".$horaDeConsultaFinalizadaSplit[2];
        }
        
        return $horaDeConsultaFinalizadaSplit[0].":".$horaDeConsultaFinalizadaSplit[1].":".$horaDeConsultaFinalizadaSplit[2];
    }//Fin calcularTiempoDeConsulta
}
