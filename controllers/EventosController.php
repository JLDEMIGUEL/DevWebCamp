<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;


class EventosController{

    public static function index($router){

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual,FILTER_VALIDATE_INT);

        if(!$pagina_actual || $pagina_actual <1){
            header('Location: /admin/eventos?page=1');
        }

        $por_pagina = 7;
        $total = Evento::total();
        $paginacion = new Paginacion($pagina_actual,$por_pagina,$total);

        $eventos = Evento::paginar($por_pagina,$paginacion->offset());

        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id)->nombre;
            $evento->hora = Hora::find($evento->hora_id)->hora;
            $evento->dia = Dia::find($evento->dia_id)->nombre;
            $ponente = Ponente::find($evento->ponente_id);
            $evento->ponente = $ponente->nombre . " " . $ponente->apellido;     
        }

        $router->render('admin/eventos/index',[
            'titulo'=> 'Conferencias y Workshops',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion()
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
