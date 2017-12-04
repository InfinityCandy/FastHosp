<?php

namespace FastHosp\Http\Controllers;

use DB;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    //Index view
    public function index() {
        $userExpediente = Session::get('expediente');
        
        //Validamos si el expediente de usuario ya fue establecido a un valor diferente del default, sino retorna la vista principal.
        if($userExpediente == "") {
            return view('index' , ['errorMessage' => '']);	 
        }
        
        //Sí el expediente del usuario ya fue establecido a un valor distinto verifica el tipo de usuario y regresa su vista principal correspondiente.
        else {
            $userExpedienteSplit = explode("-", $userExpediente);
            $userType = end($userExpedienteSplit);
            
            //Validamos si el usuario es administrativo de medicina familiar.
            if($userType == "F") {
                return redirect('administrativoFamiliar');
            }
                
            //Validamos si el usuario es administrativo es general.
            if($userType == "G") {
                return redirect('administrativoGeneral');
            }
                
            //Validamos si el usuario es médico familiar.
            if($userType == "MF") {
                return redirect('medicoFamiliar'); 
            }
                
            //Validamos si el usuario es administrativo de urgencias.
            if($userType == "U") {
                return redirect('administrativoUrgencias');
            }
                
            //Validamos si el usuario es médico urgenciologo.
            if($userType == "UM") {
                return redirect('urgenciologo');
            }
                
            //Validamos si el usuario es farmaceutico.
            if($userType == "FA") {
                return redirect('farmaceutico');
            }
        }
    	
	}
    
    //Redirecciones del login
    public function login(Request $req) {
        $userExpediente = Session::get('expediente');
        
        //Validamos sí el expediente fue establecido a un valor distinto del default, si es así entonces retornamos a la vista del index que retorna la vista de inicio del usuario correspondiente.
        if($userExpediente != "") {
            return redirect('/');	 
        }
        //Si el expediente del usuario tiene un valor default entonces permitimos que se loge
        else {
            //Almacenamos los valores ingresados en variables
            $expediente = $req->input('expediente');
            $password = $req->input('password');
        
            $expedienteSplit = explode("-", $expediente);
            $userType = end($expedienteSplit);
        
            $queryResult = NULL;//Variable "queryResult" donde se almacenarán los resultados obtenidos de la query
            
            /*Evaluamos el tipo de usuario para hacer la "query" pertienente para obtener sus datos*/
        
            //Si el usuario es de tipo "F" (administrativo familiar) o de tipo "G" (administrativo general) hacemos la query a la tabla de administrativos
            if($userType == "F" || $userType == "G" || $userType == "U") {
                $queryResult = DB::table('administrativos')
                                ->join('expedientes', 'administrativos.administrativoExpediente', '=', 'expedientes.expediente')
                                ->where('expedientes.expediente', "=", $expediente)
                                ->select('administrativos.administrativoExpediente', 'administrativos.nombre', 'administrativos.apellido', 'administrativos.password', 'administrativos.foto')
                                ->get();  
            
                //Almacenamos el nombre, apellido, expediente y foto en variables de sisión para su posterior uso en las vistas
                Session::put('nombreUsuario', $queryResult[0]->nombre." ".$queryResult[0]->apellido);
                Session::put('expediente', $queryResult[0]->administrativoExpediente);
                Session::put('fotoUsuario', "storage/".$queryResult[0]->foto);
            }
        
            //Sí el usuario es de tipo "MF" (médico familiar) hacemos la query a la tabla de médicos
            if($userType == "MF") {
                $queryResult = DB::table('medicos')
                                ->join('expedientes', 'medicos.medicoExpediente', '=', 'expedientes.expediente')
                                ->where('expedientes.expediente', "=", $expediente)
                                ->select('medicos.medicoExpediente', 'medicos.nombre', 'medicos.apellido', 'medicos.password', 'medicos.foto')
                                ->get(); 

                //Almacenamos el nombre, apellido, expediente y foto en variables de sisión para su posterior uso en las vistas
                Session::put('nombreUsuario', $queryResult[0]->nombre." ".$queryResult[0]->apellido);
                Session::put('expediente', $queryResult[0]->medicoExpediente);
                Session::put('fotoUsuario', "storage/".$queryResult[0]->foto);
            }
            
            //Sí el usuario es de tipo E (médico especialista) hacemos la query a la tabla de médicos
            if($userType == "E") {
                $queryResult = DB::table('medicos')
                                ->join('expedientes', 'medicos.medicoExpediente', '=', 'expedientes.expediente')
                                ->where('expedientes.expediente', "=", $expediente)
                                ->select('medicos.medicoExpediente', 'medicos.nombre', 'medicos.apellido', 'medicos.password', 'medicos.foto')
                                ->get(); 

                //Almacenamos el nombre, apellido, expediente y foto en variables de sisión para su posterior uso en las vistas
                Session::put('nombreUsuario', $queryResult[0]->nombre." ".$queryResult[0]->apellido);
                Session::put('expediente', $queryResult[0]->medicoExpediente);
                Session::put('fotoUsuario', "storage/".$queryResult[0]->foto);
            }

            //Sí el usuario es de tipo "UM" (urgenciologo) hacemos la query a la tabla de médicos
            if($userType == "UM") {
                $queryResult = DB::table('urgenciologos')
                                ->join('expedientes', 'urgenciologos.urgenciologoExpediente', '=', 'expedientes.expediente')
                                ->where('expedientes.expediente', "=", $expediente)
                                ->select('urgenciologos.urgenciologoExpediente', 'urgenciologos.nombre', 'urgenciologos.apellido', 'urgenciologos.password', 'urgenciologos.foto')
                                ->get(); 

                //Almacenamos el nombre, apellido, expediente y foto en variables de sisión para su posterior uso en las vistas
                Session::put('nombreUsuario', $queryResult[0]->nombre." ".$queryResult[0]->apellido);
                Session::put('expediente', $queryResult[0]->urgenciologoExpediente);
                Session::put('fotoUsuario', "storage/".$queryResult[0]->foto);
            }
            if($userType == "FA") {
                $queryResult = DB::table('farmaceuticos')
                                ->join('expedientes', 'farmaceuticos.farmaceuticoExpediente', '=', 'expedientes.expediente')
                                ->where('expedientes.expediente', "=", $expediente)
                                ->select('farmaceuticos.farmaceuticoExpediente', 'farmaceuticos.nombre', 'farmaceuticos.apellido', 'farmaceuticos.password', 'farmaceuticos.foto')
                                ->get(); 

                //Almacenamos el nombre, apellido, expediente y foto en variables de sisión para su posterior uso en las vistas
                Session::put('nombreUsuario', $queryResult[0]->nombre." ".$queryResult[0]->apellido);
                Session::put('expediente', $queryResult[0]->farmaceuticoExpediente);
                Session::put('fotoUsuario', "storage/".$queryResult[0]->foto);
            }
            
            //Validamos si obtenemos valores de retorno o sino el expediente no existe
            if($queryResult != NULL) {
                //Validamos que la contraseña ingresada conincida con la de la base de datos del usuario.
                if($queryResult[0]->password == $password) {
                    
                    //Validamos si el usuario es administrativo de medicina familiar.
                    if($userType == "F") {
                        return redirect('administrativoFamiliar');
                    }

                    //Validamos si el usuario es administrativo es general.
                    if($userType == "G") {
                        return redirect('administrativoGeneral');
                    }

                    //Validamos si el usuario es médico familiar.
                    if($userType == "MF") {
                        return redirect('medicoFamiliar'); 
                    }
                    
                    //Validamos si el usuario es médico especialista
                    if($userType == "E") {
                        return redirect('medicoEspecialista');
                    }

                    //Validamos si el usuario es administrativo de urgencias.
                    if($userType == "U") {
                        return redirect('administrativoUrgencias');
                    }

                    //Validamos si el usuario es médico urgenciologo.
                    if($userType == "UM") {
                        return redirect('urgenciologo');
                    }

                    //Validamos si el usuario es farmaceutico.
                    if($userType == "FA") {
                        return redirect('farmaceutico');
                    }

                }
                else {
                    Session::forget('nombreUsuario');
                    Session::forget('expediente');
                    Session::forget('fotoUsuario');
                    return redirect('/')->with('errorMessage', 'Error: Expediente o contraseña incorrectos.');
                }
            }
            else {
                Session::forget('nombreUsuario');
                Session::forget('expediente');
                Session::forget('fotoUsuario');
                return redirect('/')->with('errorMessage', 'Error: Expediente o contraseña incorrectos.');
            }
        }
    }
}

