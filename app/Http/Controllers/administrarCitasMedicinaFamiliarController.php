<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class administrarCitasMedicinaFamiliarController extends Controller
{
    public function listarCitasPendientes () {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        $expedienteMedico = Session::get('expediente');
        
        if($userName != "") {
            $queryResult = DB::table('citas')
                                ->join('pacientes', 'citas.expedienteDelPaciente', '=', 'pacientes.pacienteExpediente')
                                ->where('citas.expedienteDelMedico', "=", $expedienteMedico)
                                ->select('pacientes.pacienteExpediente', 'pacientes.nombre', 'pacientes.apellido', 'pacientes.foto', 'citas.fechaDeCita', 'citas.hora')
                                ->get(); 

            return view ('medicoFamiliar.listadoCitas', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult]);
        }
        else {
            return redirect('/');
        }
    }//Fin de listar citas pendientes
    
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


            return view('medicoFamiliar.consulta', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult[0],'expedienteMedico' => $expedienteMedico,'historiaClinica' => $historiaClinicaExploded]); 
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
        
        if($request->canalizarPaciente == "Si") {
            DB::table('citas_especialidads')->insert(
                ['expedientePaciente' => $request->expedientePaciente,
                 'especialidadCanalizada' => $request->especialidadCanalizar,  
                ]
            );
        }
        
        DB::table('citas')
            ->where('expedienteDelPaciente', '=', $request->expedientePaciente)->delete();
        
        return redirect('listarCitasPendientes');
    }//Fin de finalizarConsulta
}
