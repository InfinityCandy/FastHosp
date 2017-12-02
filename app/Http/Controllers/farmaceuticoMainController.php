<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class farmaceuticoMainController extends Controller
{
    //Retornar la vista de inico del urgenciologo
    public function index() {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        //Validar si la sesión fue inciada estableciendo el nombre de usuario.
        if($userName != "") {
            return view('farmaceutico.inicio', ['nombreUsuario' => $userName, 'userImage' => $userImage]);
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
            return view('farmaceutico.cambiarPassword', ['nombreUsuario' => $userName, 'error' => '',  'userImage' => $userImage]);
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
        
        $userPassword = DB::table('farmaceuticos')
                                ->select('password')
                                ->where('farmaceuticoExpediente', '=', $expediente)
                                ->get();
        
        if($userPassword[0]->password == $request->oldPassword) {
            DB::table('farmaceuticos')
                        ->where('farmaceuticoExpediente', '=', $expediente)
                        ->update(['password' => $request->newPassword]);
            
            Session::forget('nombreUsuario');
            Session::forget('expediente');
            Session::forget('fotoUsuario');
            return redirect('/');   
        }
        else {
            return view('farmaceutico.cambiarPassword', ['nombreUsuario' => $userName, 'error' => 'Error: La contraseña actual es incorrecta.', 'userImage' => $userImage]);
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
