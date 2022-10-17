<?php

namespace Classes;


class Paginacion{
    public $pagina_actual;
    public $registros_por_pagina;
    public $total_registros;


    public function __construct($pagina_actual=1,$registros_por_pagina=10,$total_registros=0)
    {
        $this->pagina_actual = (int) $pagina_actual; 
        $this->registros_por_pagina = (int) $registros_por_pagina; 
        $this->total_registros = (int) $total_registros;       
    }

    public function offset(){
        return $this->registros_por_pagina * ($this->pagina_actual - 1);
    }

    public function total_paginas(){
        return ceil($this->total_registros / $this->registros_por_pagina);
    }

    public function pagina_anterior(){
        return $this->pagina_actual > 1 ? $this->pagina_actual - 1 : false;

    }

    public function pagina_siguiente(){
        return $this->pagina_actual < $this->total_paginas() ? $this->pagina_actual + 1 : false;
    }

    public function enlace_anterior(){
        $html='';
        if($this->pagina_anterior()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_anterior()}\" >&laquo Anterior</a>";
        }
        return $html;
    }

    public function enlace_siguiente(){
        $html='';
        if($this->pagina_siguiente()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->pagina_siguiente()}\" >Siguiente &raquo</a>";
        }
        return $html;
    }

    public function numeros_paginas(){
        $html='';
        $inicio=$this->pagina_actual-2 < 1 ? 1 : $this->pagina_actual-2;
        $fin = $this->pagina_actual+2 > $this->total_paginas() ? $this->total_paginas() : $this->pagina_actual+2;

        if($this->total_paginas() - $this->pagina_actual >= 0 &&  $this->total_paginas() - $this->pagina_actual < 3){
            $inicio=$inicio - 2 + $this->total_paginas() - $this->pagina_actual < 1 ? 1 : $inicio - 2 + $this->total_paginas() - $this->pagina_actual;
        }
        if($this->pagina_actual > 0 && $this->pagina_actual < 3){
            $fin = $fin + 3 - $this->pagina_actual > $this->total_paginas() ? $this->total_paginas() : $fin + 3 - $this->pagina_actual;
        }

        if($inicio>1){
            $html.="<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page=1\">1</a>";
            if($inicio!=2)
                $html.=" ... ";
        }
            

        for($i = $inicio; $i <= $fin; $i++){
            if($i==$this->pagina_actual){
                $html.="<span class=\"paginacion__enlace paginacion__enlace--actual\">{$i}</span>";
            }else{
                $html.="<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page={$i}\">{$i}</a>";
            }
        }
        if($fin<$this->total_paginas()){
            if($fin!=$this->total_paginas()-1)
                    $html.=" ... ";
            $html.="<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page={$this->total_paginas()}\">{$this->total_paginas()}</a>";
        }
            
        return $html;
    }

    public function paginacion(){
        $html = '';

        if($this->total_registros>$this->registros_por_pagina && $this->total_registros>0){
            $html .= '<div class="paginacion">';

            $html .= $this->enlace_anterior();

            $html .= $this->numeros_paginas();

            $html .= $this->enlace_siguiente();

            $html .= '</div>';
        }

        return $html;
    }
}