<?php

namespace FastHosp\Http\Controllers;

use Session;
use DB;

use Illuminate\Http\Request;

class administrativoGeneralMainController extends Controller
{
    //Retornar la vista de inico del administrativo general
    public function index() {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        //Validar si la sesión fue inciada estableciendo el nombre de usuario.
        if($userName != "") {
            return view('administrativoGeneral.inicio', ['nombreUsuario' => $userName, 'userImage' => $userImage]);
        }
        else {
            return redirect('/');
        }  
        	
	}//Fin de index
    
    //Cambiar contraseña (formulario para cambio)
    public function cambiarPasswordForm(){
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        //Validar si la sesión fue inciada estableciendo el nombre de usuario, si es así retornamos el formulario.
        if($userName != "") {
            return view('administrativoGeneral.cambiarPassword', ['nombreUsuario' => $userName, 'error' => '',  'userImage' => $userImage]);
        }
        else {
            return redirect('/');
        } 
    }//Fin de cambiarPasswordForm
    
    //Cambiar contraseña procesar en POST
    public function cambiarPasswordPost(Request $request){
        $expediente = Session::get('expediente');
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        $userPassword = DB::table('administrativos')
                                ->select('password')
                                ->where('administrativoExpediente', '=', $expediente)
                                ->get();
        
        if($userPassword[0]->password == $request->oldPassword) {
            DB::table('administrativos')
                        ->where('administrativoExpediente', '=', $expediente)
                        ->update(['password' => $request->newPassword]);
            
            Session::forget('nombreUsuario');
            Session::forget('expediente');
            Session::forget('fotoUsuario');
            return redirect('/');   
        }
        else {
            return view('administrativoGeneral.cambiarPassword', ['nombreUsuario' => $userName, 'error' => 'Error: La contraseña actual es incorrecta.', 'userImage' => $userImage]);
        }
    }//Fin cambiarPasswordPost
    
    //Salir de la sesión
    public function logout() {
        Session::forget('nombreUsuario');
        Session::forget('expediente');
        Session::forget('fotoUsuario');
        return redirect('/');
    }//Fin de logout
}
