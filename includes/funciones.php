<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) : bool{
    return str_contains($_SERVER['PATH_INFO'] ?? '/',$path);
}

function is_auth():bool{
    if(!isset($_SESSION))
        session_start();
    return !empty($_SESSION) && isset($_SESSION['nombre']);
}


function is_admin():bool{
    if(!isset($_SESSION))
        session_start();
    return !empty($_SESSION['admin']) && isset($_SESSION['admin']);
}


function aos_animacion(){
    $efectos = ['fade-up', 'fade-down', 'fade-right', 'fade-left',
        'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down',
        'zoom-out'];
    echo ' data-aos="'.$efectos[array_rand($efectos, 1)]. ' ';
}