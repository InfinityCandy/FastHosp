<?php

namespace FastHosp\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ajaxHelper extends Controller
{
    public function obtenerNombreDePaciente($expediente) {
        $validExpediente = strtoupper($expediente);
        
        if($validExpediente != $expediente) {
            echo "404";
        }
        else {
            $queryResult = DB::table('pacientes')
                           ->select('nombre', 'apellido')
                           ->where('pacienteExpediente', "=", $expediente)
                           ->get();
        
            if(count($queryResult) > 0 ) {
                echo $queryResult[0]->nombre." ".$queryResult[0]->apellido;
            }
            else {
                echo "404";
            } 
        }
          
    }//Fin de obtenerNombreDePaciente
    
    public function obtenerExpedienteMedicoAsignado($turno) {
        //Obtenemos los expedientes y turnos de todos los médicos registrados en el sistema
        $medicosFamiliares = DB::table('medicos')
                                ->select('medicoExpediente', 'turno')
                                ->where([
                                    ['especialidad', "=", 2],
                                    ['turno', "=", $turno]
                                ])
                                //->where('especialidad', "=", 2)
                                ->get();
        
        //Obtenemos la cantidad de citas que tiene asifnado cada médico
        for($i = 0; $i < sizeof($medicosFamiliares); $i++) {
            $queryResult = DB::table('citas')
                ->where('expedienteDelMedico', "=", $medicosFamiliares[$i]->medicoExpediente)
                ->count();
                    
            $medicosFamiliares[$i]->cantidadCitas = $queryResult;
        }
        
        //Obtenemos el médico con el menor número de citas asignadas
        $minimo = $medicosFamiliares[0]->cantidadCitas;
        $minimoPosicion = 0;
        for($i = 0; $i < sizeof($medicosFamiliares); $i++) {
            if($medicosFamiliares[$i]->cantidadCitas < $minimo) {
                $minimo = $medicosFamiliares[$i]->cantidadCitas;
                $minimoPosicion = $i;
            }
        }
        
        echo $medicosFamiliares[$minimoPosicion]->medicoExpediente."/".$medicosFamiliares[$minimoPosicion]->turno;
        
    }//Fin de obtenerExpedienteMedicoAsignado
    
    public function obtenerDatosDeUrgencia() {
        //Determinamos el turno segun la hora para saber que urgenciologos tomar de la base de datos y cuales no
        $time = time();
        date_default_timezone_set('America/Mexico_City');
        $horaActual =  date('H:i:s', $time);
        
        $turno = 'Matutino';
        if(strtotime($horaActual) >= strtotime('08:00:00') && strtotime($horaActual) < strtotime('16:00:00')) {
            $turno = 'Matutino';
        }
        
        if(strtotime($horaActual) >= strtotime('16:00:00') && strtotime($horaActual) < strtotime('23:59:00')) {
            $turno = 'Vespertino';
        }
        
        if(strtotime($horaActual) >= strtotime('00:00:00') && strtotime($horaActual) < strtotime('08:00:00')) {
            $turno = 'Nocturno';
        }
        
        //Obtenemos el expediente y turno de cada uno de los urgenciologos
        $urgenciologosInfo = DB::table('urgenciologos')
                                ->select('urgenciologoExpediente', 'turno', 'nombre', 'apellido', 'consultorioAsignado')
                                ->where('turno', "=", $turno)
                                ->get();
        
        //Obtenemos la duración de las consultas de cada uno de los urgenciologos antes obtenidos
        //Almacenamos el arreglo de la duración de las consultas dentro de la estructura "$urgenciologosInfo" en la variable "historico"
        for($i = 0; $i < sizeof($urgenciologosInfo); $i++) {
            $urgenciologosInfo[$i]->historico = DB::table('historico_tiempo_de_consultas')
                            ->select('duracionDeConsulta')
                            ->where('expedienteUrgenciologo', '=', $urgenciologosInfo[$i]->urgenciologoExpediente)
                            ->get(); 
        }
        
        //Calculamos el promedio de los que tarda cada urgenciologo en consulta con base en los datos de la variable "historico"
        //Almacenamos el resultado de calulara el promedio de la duración de las consultas en la variable "promedioTiempoConsulta"
        for($i = 0; $i < sizeof($urgenciologosInfo); $i++) {
            $promedio = 0;
        
            //Obtenemos cada uno de los historicos de tiempos de consulta y lo pasamos a segundos y almacenamos el resultado en la variable promedio
            for($x = 0; $x < sizeof($urgenciologosInfo[$i]->historico); $x++) {
                $promedio += strtotime($urgenciologosInfo[$i]->historico[$x]->duracionDeConsulta);
            }
            
            //Sacamos el promedio con base en los historicos de consulta pasados a segundos y la cantidad de datos en la variables historico
            if(count($urgenciologosInfo[$i]->historico) != 0) {
                $promedio = $promedio / count($urgenciologosInfo[$i]->historico);
            }
            else {
                $promedio = strtotime('00:15:00');
            }
            
            
            //Pasamos los segundos a un formato de horas:minutos:segundos
            $promedioTiempo = date('H:i:s', $promedio);
            
            //Almacenamos el resultado del promedio en formato de horas:minutos:segundos en la variable "promedioTiempoConsulta"
            $urgenciologosInfo[$i]->promedioTiempoConsulta = $promedioTiempo;
        }
        
        //Obtenemos la cantidad de citas que tiene asigando cada urgenciologo en la tabla cita_urgencias y almacenamos esa cantidad en la variable "totalCitas".
        for($i = 0; $i < sizeof($urgenciologosInfo); $i++) {
            $totalDeCitasUrgenciologo = count(DB::table('cita_urgencias')
                            ->select()
                            ->where('expedienteUrgenciologo', '=', $urgenciologosInfo[$i]->urgenciologoExpediente)
                            ->get()); 
            
            $urgenciologosInfo[$i]->totalCitas = $totalDeCitasUrgenciologo;
        }
        
        $pos = $this->calcularMenorTiempo($urgenciologosInfo);
        
        $tiempoDeCitas = date('H:i:s', $urgenciologosInfo[$pos]->totalCitas * strtotime($urgenciologosInfo[$pos]->promedioTiempoConsulta));
        
        //Función para comvertir el tiempoDeCitas a segundos.
        $tiempoDeCitasSegundos = $this->pasarTiempoDeCitasASegundos($tiempoDeCitas);
        
        $tiempoTotalDeCitas = strtotime($horaActual) + $tiempoDeCitasSegundos;
        
        $this->obtenerDatoDeCita($tiempoTotalDeCitas, $turno, $urgenciologosInfo, $pos);
    }
    
    public function calcularMenorTiempo($urgenciologosInfo) {
        $menor = strtotime($urgenciologosInfo[0]->promedioTiempoConsulta) * $urgenciologosInfo[0]->totalCitas ;
        $pos = 0;
        
        for($i = 0; $i < sizeof($urgenciologosInfo); $i++) {
            $temp = $urgenciologosInfo[$i]->totalCitas * strtotime($urgenciologosInfo[$i]->promedioTiempoConsulta);
            
            if($temp < $menor) {
                $menor = $temp;
                $pos = $i;
            }
        }
        
        return $pos;
    }//Fin de calcularMenorTiempo
    
    public function pasarTiempoDeCitasASegundos($tiempoDeCitas) {
        $tiempoDeCitasSplit = explode(':', $tiempoDeCitas);
        
        $segundos = 0;
        if($tiempoDeCitasSplit[0] != '00') {
           $segundos = $segundos + ((int)$tiempoDeCitasSplit[0] * 3600); 
        }
        if($tiempoDeCitasSplit[1] != '00') {
            $segundos = $segundos + ((int)$tiempoDeCitasSplit[1] * 60); 
        }
        if($tiempoDeCitasSplit[2] != '00') {
            $segundos = $segundos + (int)$tiempoDeCitasSplit[2]; 
        }
        
        return $segundos;
    }//Fin de pasarTiempoDeCitasASegundos
    
    public function obtenerDatoDeCita($tiempoTotalDeCitas, $turno, $urgenciologosInfo, $pos) {
        //Verifica si el urgenciologo es de turno Matutino, si es así verifica si aún tiene espacio para otro paciente antes de su fin de turno
       if($turno == 'Matutino') {
            if($tiempoTotalDeCitas < strtotime('16:00:00')) {
                echo $urgenciologosInfo[$pos]->urgenciologoExpediente."/".$urgenciologosInfo[$pos]->nombre." ".$urgenciologosInfo[$pos]->apellido."/".($urgenciologosInfo[$pos]->totalCitas + 1)."/".$urgenciologosInfo[$pos]->consultorioAsignado;
            }
            else {
                $urgenciologosInfoAlternativo = DB::table('urgenciologos')
                                ->select('urgenciologoExpediente', 'turno', 'nombre', 'apellido', 'consultorioAsignado')
                                ->where('turno', "=", 'Matutino')
                                ->get();
                
                $totalDeCitasUrgenciologoAlternativo = count(DB::table('cita_urgencias')
                            ->select()
                            ->where('expedienteUrgenciologo', '=', $urgenciologosInfoAlternativo[0]->urgenciologoExpediente)
                            ->get()); 
            
                $urgenciologosInfoAlternativo[0]->totalCitas = $totalDeCitasUrgenciologoAlternativo; 
                
                echo $urgenciologosInfo[0]->urgenciologoExpediente."/".$urgenciologosInfo[0]->nombre." ".$urgenciologosInfo[0]->apellido."/".($urgenciologosInfo[0]->totalCitas + 1)."/".$urgenciologosInfo[0]->consultorioAsignado;   
            }
        }
        
        //Verifica si el urgenciologo es de turno Vespertino, si es así verifica si aún tiene espacio para otro paciente antes de su fin de turno
        if($turno == 'Vespertino') {
            if($tiempoTotalDeCitas < strtotime('23:59:00')) {
                echo $urgenciologosInfo[$pos]->urgenciologoExpediente."/".$urgenciologosInfo[$pos]->nombre." ".$urgenciologosInfo[$pos]->apellido."/".($urgenciologosInfo[$pos]->totalCitas + 1)."/".$urgenciologosInfo[$pos]->consultorioAsignado;
            }
            else {
                
               $urgenciologosInfoAlternativo = DB::table('urgenciologos')
                                ->select('urgenciologoExpediente', 'turno', 'nombre', 'apellido', 'consultorioAsignado')
                                ->where('turno', "=", 'Nocturno')
                                ->get();
                
                $totalDeCitasUrgenciologoAlternativo = count(DB::table('cita_urgencias')
                            ->select()
                            ->where('expedienteUrgenciologo', '=', $urgenciologosInfoAlternativo[0]->urgenciologoExpediente)
                            ->get()); 
            
               $urgenciologosInfoAlternativo[0]->totalCitas = $totalDeCitasUrgenciologoAlternativo;  
                
                echo $urgenciologosInfoAlternativo[0]->urgenciologoExpediente."/".$urgenciologosInfoAlternativo[0]->nombre." ".$urgenciologosInfoAlternativo[0]->apellido."/".($urgenciologosInfoAlternativo[0]->totalCitas + 1)."/".$urgenciologosInfoAlternativo[0]->consultorioAsignado;
            }
        }
        
                
        //Verifica si el urgenciologo es de turno Noctuno, si es así verifica si aún tiene espacio para otro paciente antes de su fin de turno
        if($turno == 'Nocturno') {
            if($tiempoTotalDeCitas < strtotime('08:00:00')) {
                echo $urgenciologosInfo[$pos]->urgenciologoExpediente."/".$urgenciologosInfo[$pos]->nombre." ".$urgenciologosInfo[$pos]->apellido."/".($urgenciologosInfo[$pos]->totalCitas + 1)."/".$urgenciologosInfo[$pos]->consultorioAsignado;
            }
            else {
                $urgenciologosInfoAlternativo = DB::table('urgenciologos')
                                ->select('urgenciologoExpediente', 'turno', 'nombre', 'apellido', 'consultorioAsignado')
                                ->where('turno', "=", 'Matutino')
                                ->get();
                
                $totalDeCitasUrgenciologoAlternativo = count(DB::table('cita_urgencias')
                            ->select()
                            ->where('expedienteUrgenciologo', '=', $urgenciologosInfoAlternativo[0]->urgenciologoExpediente)
                            ->get()); 
            
                $urgenciologosInfoAlternativo[0]->totalCitas = $totalDeCitasUrgenciologoAlternativo; 
                
                echo $urgenciologosInfo[0]->urgenciologoExpediente."/".$urgenciologosInfo[0]->nombre." ".$urgenciologosInfo[0]->apellido."/".($urgenciologosInfo[0]->totalCitas + 1)."/".$urgenciologosInfo[0]->consultorioAsignado;
            }
        }
    }//Fin de obtenerDatoDeCita
}
