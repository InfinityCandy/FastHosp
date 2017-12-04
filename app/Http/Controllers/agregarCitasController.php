<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class agregarCitasController extends Controller
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
            return view('administrativoFamiliar.transaccionesEstado', ['nombreUsuario' => $userName, 'userImage' => $userImage]); 
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
            return view('administrativoFamiliar.agregarCita', ['nombreUsuario' => $userName, 'userImage' => $userImage]); 
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
         $queryStatus = DB::table('citas')->insert(
                ['expedienteDelPaciente' => $request->expedientePaciente,
                'nombreDelPaciente' => $request->nombrePaciente,
                'expedienteDelMedico' => $request->expedienteMedico,
                'fechaDeCita' => $request->fechaDeCita,
                'hora' => $request->horaCita,
                'consultorio' => $request->consultorio,
                ]
         );
         if($queryStatus) {
            $datosDelMedico = DB::table('medicos')
                                ->select('nombre', 'apellido')
                                ->where('medicoExpediente', "=", $request->expedienteMedico)
                                ->get();
        
            $tempNombreMedico = 'Nombre del médico: '.$datosDelMedico[0]->nombre.' '.$datosDelMedico[0]->apellido;
            $tempExpedienteMedico = 'Expediente del médico: '.$request->expedienteMedico;
            $tempFechaCita = 'Fecha de la cita: '.$request->fechaDeCita;
            $tempHoraCita = 'Hora de la cita: '.$request->horaCita;
            $tempConsultorio = 'Consultorio: '.$request->consultorio;
             
            return redirect('agregarCita')->with(array('succesStatus'=>'Cita agendada con exito!', 'nombreMedico'=>$tempNombreMedico, 'expedienteMedico'=>$tempExpedienteMedico, 'fechaCita'=>$tempFechaCita, 'horaCita'=>$tempHoraCita, 'consultorio'=>$tempConsultorio));
         }
         else {
            return redirect('agregarCita')->with('errorStatus', 'Error: No ha sido posible agendar la cita!');
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
