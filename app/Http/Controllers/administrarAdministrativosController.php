<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use DB;

class administrarAdministrativosController extends Controller
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
        
        //Validar si la sesión fue inciada estableciendo el nombre de usuario, si es así retornamos el formulario
        if($userName != "") {
            return view('administrativoGeneral.registrarAdministrativo', ['nombreUsuario' => $userName, 'userImage' => $userImage]); 
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
        //Establecemos el valor del id que debe corresponder al último registro en la tabla
        $lastId = 0;
        $temp = DB::table('administrativos')->get();
        if(count($temp) == 0) {
            $lastId = 1;
        }
        else {
            $lastId = DB::table('administrativos')
                                ->select('id')
                                ->orderBy('id', 'desc')
                                ->limit(1)
                                ->value("id");
            $lastId = $lastId + 1;
        }
        
        
        //"Spliteando" la fecha de nacimiento 
        $fechaDeNacimeintoSplit = explode("-", $request->FechaDeNacimiento);
        
        //Construcción del expediente Formato: ÚltimoIdDB-fech[dia, mes, año]-admon-tipo
        $expediente = $lastId."-".$fechaDeNacimeintoSplit[2]."".$fechaDeNacimeintoSplit[1]."".substr($fechaDeNacimeintoSplit[0], 2, 3)."-admon";
        $expediente = $expediente."-".$request->tipo;
        
         //Almacenamos la imagen y obtenemos la ruta de la misma para agregarla a la base de datos
        $imagePath = $request->foto->storeAs('public/userImages', $expediente.'-userImage.jpg'); 
        $imagePath = str_replace("public/","", $imagePath);
        
        echo $imagePath;
        
        //Insertamos expediente en la tabla expedientes
        $queryStatus1 = DB::table('expedientes')->insert(
            ['expediente' => $expediente,]
        );
        
        //Insertar datos del administrativo en la tabla administrativos
        if($queryStatus1) {
            $queryStatus2 = DB::table('administrativos')->insert(
                ['administrativoExpediente' => $expediente,
                'password' => $expediente.".",
                'nombre' => $request->nombre,
                'apellido' => $request->apellidos,
                'foto' => $imagePath,
                'fechaDeNacimiento' => $request->FechaDeNacimiento,
                'edad' => $request->edad,
                'email' => $request->email,
                'numeroDeTelefono' => $request->telefono,
                'lugarDeNacimiento' => $request->lugarDeNacimientoPais.", ".$request->lugarDeNacimientoEstado,
                'direccion' => $request->direccion,
                'estadoCivil' => $request->estadoCivil,
                'gradoDeEstudios' => $request->GradoDeEstudios,
                'tipo' => $request->tipo,
                ]
            );
            if($queryStatus2) {
                return redirect('administrarAdministrativos')->with('succesStatus', 'Administrativo registrado con exito! Expediente: '.$expediente);
            }
            else {
                return redirect('administrarAdministrativos')->with('errorStatus', 'Error: No ha sido posible realizar el registro!');
            }
        }
        else {
            return redirect('administrarAdministrativos')->with('errorStatus', 'Error: No ha sido posible realizar el registro!');
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
