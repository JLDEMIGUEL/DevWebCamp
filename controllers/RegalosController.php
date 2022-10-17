<?php

namespace Controllers;

use MVC\Router;


class RegalosController{

    public static function index($router){
        $router->render('admin/regalos/index',[
            'titulo'=> 'Regalos'
        ]);
    }
}
