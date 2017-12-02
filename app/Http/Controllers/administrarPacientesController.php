<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Session;

class administrarPacientesController extends Controller
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
            return view('administrativoGeneral.transaccionesEstado', ['nombreUsuario' => $userName, 'userImage' => $userImage]); 
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
            return view('administrativoGeneral.registrarPaciente', ['nombreUsuario' => $userName, 'userImage' => $userImage]); 
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
        /*$this->validate($request, [
            'nombre' => 'required',
            'apellidos' => 'required',
        ]);*/
        
        //Establecemos el valor del id que debe corresponder al último registro en la tabla
        $lastId = 0;
        $test = DB::table('pacientes')->get();
        if(count($test) == 0) {
            $lastId = 1;
        }
        else {
            $lastId = DB::table('pacientes')
                                ->select('id')
                                ->orderBy('id', 'desc')
                                ->limit(1)
                                ->value("id");
            
            $lastId = $lastId + 1;
        }
        
        
        //"Spliteando" la fecha de nacimiento
        $fechaDeNacimeintoSplit = explode("-", $request->FechaDeNacimiento);
        
        //Construcción del expediente Formato: ÚltimoIdDB-fech[dia, mes, año]-p
        $expediente = $lastId."-".$fechaDeNacimeintoSplit[2]."".$fechaDeNacimeintoSplit[1]."".substr($fechaDeNacimeintoSplit[0], 2, 3)."-P";
        
        //Almacenamos la imagen y obtenemos la ruta de la misma para agregarla a la base de datos
        $imagePath = $request->foto->storeAs('public/userImages', $expediente.'-userImage.jpg'); 
        $imagePath = str_replace("public/","", $imagePath);
        
        //Insertar expediente en la tabla expedientes
        $queryStatus1 = DB::table('expedientes')->insert(
            ['expediente' => $expediente,]
        );
        
        
        if($queryStatus1) {
            //Insertar datos del paciente en la tabla pacientes
            $queryStatus2 = DB::table('pacientes')->insert(
                ['pacienteExpediente' => $expediente,
                'password' => $expediente.".",
                'nombre' => $request->nombre,
                'apellido' => $request->apellidos,
                'foto' => $imagePath,
                'edad' => $request->edad,
                'fechaDeNacimiento' => $request->FechaDeNacimiento,
                'tipoDeSangre' => $request->tipoDeSangre,
                'email' => $request->email,
                'estadoCivil' => $request->estadoCivil,
                'gradoDeEstudios' => $request->GradoDeEstudios,
                'ocupacion' => $request->ocupacion,
                'lugarDeNacimiento' => $request->lugarDeNacimientoPais.", ".$request->lugarDeNacimientoEstado,
                'direccion' => $request->direccion,
                'personaDeConfianza1' => $request->personaDeConfianza1,
                'personaDeConfianza2' => $request->personaDeConfianza2,
                'telefonoPersonaDeConfianza1' => $request->telefonoPersonaDeConfianza1,
                'telefonoPersonaDeConfianza2' => $request->telefonoPersonaDeConfianza2,
                'numeroDeTelefono' => $request->telefono,
                'tipoDeAfiliacion' => $request-> tipoDeAfiliacion,
                ]
            );
            
            //Creamos el historial clinico del paciente ingresando su expediente en la tabla de historial clinico
            DB::table('historial_clinicos')->insert(
                ['expedientePaciente' => $expediente,]
            );
            if($queryStatus2) {
                return redirect('administrarPacientes')->with('succesStatus', 'Paciente registrado con exito!'.' Expediente del paciente: '.$expediente);
            }
            else {
                return redirect('administrarPacientes')->with('errorStatus', 'Error: No ha sido posible realizar el registro!');
            }
        }
        else {
            return redirect('administrarPacientes')->with('errorStatus', 'Error: No ha sido posible realizar el registro!');
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
