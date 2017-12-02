<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class agregarCitasDeUrgenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        //Validar si la sesión fue inciada estableciendo el nombre de usuario.
        if($userName != "") {
            return view('administrativoUrgencias.transaccionesEstado', ['nombreUsuario' => $userName, 'userImage' => $userImage]); 
        }
        else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userName = Session::get('nombreUsuario');
        $userImage = Session::get('fotoUsuario');
        
        //Validar si la sesión fue inciada estableciendo el nombre de usuario, si es así retornamos el formulario.
        if($userName != "") {
            return view('administrativoUrgencias.agregarCita', ['nombreUsuario' => $userName, 'userImage' => $userImage]); 
        }
        else {
            return redirect('/');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $queryStatus = DB::table('cita_urgencias')->insert(
                ['expedientePaciente' => $request->expedientePaciente,
                'expedienteUrgenciologo' => $request->expedienteUrgenciologo,
                'nombreMedico' => $request->nombreMedico,
                'consultorio' => $request->consultorio,
                'turno' => $request->turno,
                'fechaDeHoy' => $request->fechaDeHoy,
                ]
         );
         if($queryStatus) {
            $tempExpedientePaciente = 'Expediente del paciente: '.$request->expedientePaciente;
            $tempExpedienteMedico = 'Expediente del médico: '.$request->expedienteUrgenciologo;
            $tempNombreMedico = 'Nombre del médico: '.$request->nombreMedico;
            $tempConsultorio = 'Consultorio: '.$request->consultorio;
            $tempTurno = 'Turno: '.$request->turno;
             
            return redirect('agregarCitaUrgencias')->with(array('succesStatus'=>'Cita agendada con exito!', 'expdientePaciente'=>$tempExpedientePaciente, 'nombreMedico'=>$tempNombreMedico, 'expedienteMedico'=>$tempExpedienteMedico, 'consultorio'=>$tempConsultorio, 'turno'=>$tempTurno));
         }
         else {
           return redirect('agregarCitaUrgencias')->with('errorStatus', 'Error: No ha sido posible agendar la cita!');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
