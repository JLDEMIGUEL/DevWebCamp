<?php
namespace Controllers;

use Exception;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\EventosRegistros;
use Model\Hora;
use Model\Paquete;
use Model\Ponente;
use Model\Regalo;
use Model\Registro;
use Model\Usuario;
use MVC\Router;
use Throwable;

class RegistroController{

    public static function crear(Router $router){

        if(!is_auth()){
            header('Location: /login');
            return;
        }

        $registro = Registro::where('usuario_id',$_SESSION['id']);

        if(isset($registro) && ($registro->paquete_id === "3" || $registro->paquete_id === "2")){
            header('Location: /boleto?id='. urlencode($registro->token)); 
            return; 
        }

        if(isset($registro) && $registro->paquete_id === "1"){
            header('Location: /finalizar-registro/conferencias');  
            return;
        }

        
        $router->render('registro/crear', [
            'titulo'=>'Finalizar Registro'
        ]);
    }

    public static function gratis(Router $router){

        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }

            $registro = Registro::where('usuario_id',$_SESSION['id']);

            if(isset($registro) && $registro->paquete_id === "3"){
                header('Location: /boleto?id='. urlencode($registro->token));
                return;  
            }

            $token = substr(md5(uniqid(rand(), true)),0,8);

            $datos = array(
                'paquete_id'=> 3,
                'pago_id'=>'',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );

            $registro = new Registro($datos);

            $resultado = $registro->guardar($registro);
            if($resultado){
                header('Location: /boleto?id='. urlencode($registro->token));
                return;
            }
        }
    }

    public static function boleto(Router $router){

        $id = $_GET['id'];
        if(!$id || strlen($id) !== 8){
            header('Location: /');
            return;
        }

        $registro = Registro::where('token', $id);
        
        if(!$registro){
            header('Location: /');
            return;
        }

        $registro->usuario = Usuario::find($registro->usuario_id);

        $registro->paquete = Paquete::find($registro->paquete_id);

        $router->render('registro/boleto', [
            'titulo'=>'Asistencia a DevWebCamp',
            'registro'=>$registro
        ]);
    }


    public static function pagar(Router $router){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }

            if(empty($_POST)){
                echo json_encode([]);
                return;
            }

            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)),0,8);
            $datos['usuario_id'] = $_SESSION['id'];
            try{
                $registro = new Registro($datos);
                $resultado = $registro->guardar($registro);
                echo json_encode($resultado);
            }catch(Throwable $e){
                echo json_encode(['resultado'=>'error']);
            }
            
        }
    }



    public static function conferencias(Router $router){

        if(!is_auth()){
            header('Location: /login');
            return;
        }

        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);

        if(!isset($registro)){
            header('Location: /finalizar-registro');
            return;
        }
 
        if($registro->paquete_id !== "1"){
            header('Location: /boleto?id='. urlencode($registro->token));
            return;
        }
       

        $numEventos = EventosRegistros::total('registro_id', $registro->id);
        
        if( $numEventos != 0) {
            header('Location: /boleto?id=' . urlencode($registro->token));
        }

        $eventos = Evento::ordenar('hora_id','ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id)->nombre;
            $evento->hora = Hora::find($evento->hora_id)->hora;
            $evento->dia = Dia::find($evento->dia_id)->nombre;
            $ponente = Ponente::find($evento->ponente_id);
            $evento->ponente = $ponente; 
            if($evento->dia_id === "1" && $evento->categoria_id === "1"){
                $eventos_formateados['conferencias_v'][]=$evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "1"){
                $eventos_formateados['conferencias_s'][]=$evento;
            }
            if($evento->dia_id === "1" && $evento->categoria_id === "2"){
                $eventos_formateados['workshops_v'][]=$evento;
            }
            if($evento->dia_id === "2" && $evento->categoria_id === "2"){
                $eventos_formateados['workshops_s'][]=$evento;
            }
        }

        $regalos = Regalo::all('ASC');


        if($_SERVER['REQUEST_METHOD']==='POST'){

            $eventos = explode(',', $_POST['eventos']);

            if(empty($eventos)){
                echo json_encode(['resultado'=>false]);
                return;
            }

            $registro = Registro::where('usuario_id', $_SESSION['id']);

            if(!isset($registro) || $registro->paquete_id !== "1"){
                echo json_encode(['resultado'=>false]);
                return;
            }

            $eventosArray=[];
            foreach($eventos as $evento_id){
                $evento = Evento::find($evento_id);

                if(!isset($evento) || $evento->disponibles === "0"){
                    echo json_encode(['resultado'=>false]);
                    return;
                }
                $eventosArray[]=$evento;
            }
            foreach($eventosArray as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();

                $datos = [
                    'evento_id'=>(int)$evento->id,
                    'registro_id'=>(int)$registro->id
                ];

                $registroUsuario = new EventosRegistros($datos);
                $registroUsuario->guardar();
            }

            $registro->sincronizar(['regalo_id'=>$_POST['regalo_id']]);
            $resultado = $registro->guardar();

            if($resultado){
                echo json_encode(['resultado'=>$resultado, 'token'=>$registro->token]);
            }else{
                echo json_encode(['resultado'=>false]);
            }
            
            return;
        }

        $router->render('registro/conferencias', [
            'titulo'=>'Elige Workshops y Conferencias',
            'eventos'=>$eventos_formateados,
            'regalos'=>$regalos
        ]);
    }
}