<?php

namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use MVC\Router;


class EventosController{

    public static function index($router){
        $router->render('admin/eventos/index',[
            'titulo'=> 'Conferencias y Workshops'
        ]);
    }


    public static function crear($router){

        $alertas=[];

        $evento = new Evento();

        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $evento->sincronizar($_POST);

            $alertas = $evento->validar();

            if(empty($alertas)){
                $resultado = $evento->guardar();
                if($resultado){
                    header('Location: /admin/eventos');
                }
            }
        }


        $router->render('admin/eventos/crear',[
            'titulo'=> 'Registrar Evento',
            'alertas'=>$alertas,
            'evento'=>$evento,
            'categoria'=>$categorias,
            'dias' => $dias,
            'horas' => $horas
        ]);
    }
}
