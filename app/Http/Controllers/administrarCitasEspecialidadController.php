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
            
            return view ('medicoEspecialista.listadoCitas', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult]);
        }
        else {
            return redirect('/');
        }
    }//Fin de listarCitasPendientes
}
