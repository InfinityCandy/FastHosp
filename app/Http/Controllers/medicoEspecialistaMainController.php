<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class medicoEspecialistaMainController extends Controller
{
    //Retornar la vista de inico del médico de especialista
    public function index() {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        if($userName != "") {
            return view('medicoEspecialista.inicio', ['nombreUsuario' => $userName, 'userImage' => $userImage]);
        }
        else {
            return redirect('/');
        }
    }//Fin del index
    
    //Cambiar contraseña (formulario para cambio)
    public function cambiarPasswordForm(){
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        //Validar si la sesión fue inciada estableciendo el nombre de usuario, si es así retornamos el formulario.
        if($userName != "") {
            return view('medicoEspecialista.cambiarPassword', ['nombreUsuario' => $userName, 'error' => '',  'userImage' => $userImage]);
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
        
        $userPassword = DB::table('medicos')
                                ->select('password')
                                ->where('medicoExpediente', '=', $expediente)
                                ->get();
        
        if($userPassword[0]->password == $request->oldPassword) {
            DB::table('medicos')
                        ->where('medicoExpediente', '=', $expediente)
                        ->update(['password' => $request->newPassword]);
            
            Session::forget('nombreUsuario');
            Session::forget('expediente');
            Session::forget('fotoUsuario');
            return redirect('/');   
        }
        else {
            return view('medicoEspecialista.cambiarPassword', ['nombreUsuario' => $userName, 'error' => 'Error: La contraseña actual es incorrecta.', 'userImage' => $userImage]);
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
