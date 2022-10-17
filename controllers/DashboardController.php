<?php

namespace Controllers;

use MVC\Router;


class DashboardController{

    public static function index($router){
        $router->render('admin/dashboard/index',[
            'titulo'=> 'Panel administracion'
        ]);
    }
}
