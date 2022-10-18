<?php


namespace Controllers;

use Model\Ponente;

class APIPonentes{

    public static function index(){
        $ponentes = Ponente::All();
        echo json_encode($ponentes);
    }
}