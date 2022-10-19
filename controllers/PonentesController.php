<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Ponente;

class PonentesController{

    public static function index(Router $router){

        if(!is_admin()){
            header('Location: /login');
        }
        
        $pagina_actual=filter_var($_GET['page'],FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual<1){ header('Location: /admin/ponentes?page=1');}

        $registros_por_pagina=6;

        $total_registros=Ponente::total();


        $paginacion = new Paginacion($pagina_actual,$registros_por_pagina,$total_registros);
         
        if($paginacion->total_paginas()<$pagina_actual){header('Location: /admin/ponentes?page=1');}


        $ponentes = Ponente::paginar($registros_por_pagina,$paginacion->offset());


        $router->render('admin/ponentes/index',[
            'titulo'=> 'Ponentes / Conferencistas',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear($router){

        if(!is_admin()){
            header('Location: /login');
        }

        $alertas=[];

        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';

                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes,0777,true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png',80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp',80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen']=$nombre_imagen;
            }

            $_POST['redes'] = json_encode($_POST['redes'],JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);


            $alertas = $ponente->validar();

            if(empty($alertas)){

                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');

                $resulatdo = $ponente->guardar();

                if($resulatdo){
                    header('Location: /admin/ponentes');
                }else{
                    $alertas['error'][]='No se ha podido guardar el ponente';
                }
            }
        }

        $router->render('admin/ponentes/crear',[
            'titulo'=> 'Registrar Ponente',
            'alertas'=>$alertas,
            'redes' =>  json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router){

        if(!is_admin()){
            header('Location: /login');
        }

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if(!$id){
            header('Location: /admin/ponentes');
        }

        $ponente = Ponente::find($id);

        if(!$ponente){
            header('Location: /admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;

        $alertas = [];


        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';

                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes,0777,true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png',80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp',80);

                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen']=$nombre_imagen;
            }else{
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'],JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if(empty($alertas)){
                if($nombre_imagen){
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');    
                }
                $resulatdo = $ponente->guardar();

                if($resulatdo){
                    header('Location: /admin/ponentes');
                }else{
                    $alertas['error'][]='No se ha podido guardar el ponente';
                }
            }

        }


        $router->render('admin/ponentes/editar',[
            'titulo'=> 'Editar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente ?? null,
            'redes' =>  json_decode($ponente->redes)
        ]);
    }


    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id){
                header('Location: /admin/ponentes');
            }

            $ponente = Ponente::find($id);

            if(!isset($ponente)){
                header('Location: /admin/ponentes');
            }
            $ponente->eliminar();

            header('Location: /admin/ponentes');
        }
    }

}


?>