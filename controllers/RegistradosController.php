<?php

namespace Controllers;

use MVC\Router;


class RegistradosController{

    public static function index($router){
        $router->render('admin/registrados/index',[
            'titulo'=> 'Usuarios Registrados'
        ]);
    }
}
