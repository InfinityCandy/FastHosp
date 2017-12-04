<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class administrarRecetasDeFarmacosController extends Controller
{
    public function listarPeticionesEnFarmacia () {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        if($userName != "") {
            $queryResult = DB::table('medicamentos')
                                ->select('expedienteDelPaciente')
                                ->get();
            
            return view('farmaceutico.listadoPeticionesFarmacia', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'peticiones' => $queryResult]);
        }
        else {
            return redirect('/');
        }
    }
    
    public function iniciarDespachoDeFarmacos ($expedientePaciente) {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        if($userName != "") {
            $queryResult = DB::table('medicamentos')
                                ->join('pacientes', 'pacientes.pacienteExpediente', '=', 'medicamentos.expedienteDelPaciente')
                                ->where('pacientes.pacienteExpediente', "=", $expedientePaciente)
                                ->select('pacientes.pacienteExpediente', 'pacientes.nombre', 'pacientes.apellido', 'pacientes.foto', 'medicamentos.medicamentos', 'medicamentos.id')
                                ->get(); 
            
            return view('farmaceutico.iniciarDespachoDeFarmacos', ['nombreUsuario' => $userName, 'userImage' => $userImage, 'pacienteInfo' => $queryResult]);
        }
        else {
            return redirect('/');
        }
    }
    
    public function despacharPeticionDeFarmaco (Request $request) {
        DB::table('medicamentos')
            ->where('id', '=', $request->idDePeticion)->delete();
        
        return redirect('listarPeticionesEnFarmacia');
        
    }
}
