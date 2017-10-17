<?php

namespace Talaka\Models;

class Page{
    
    private $view = "";
    
    public function curl($httpMethod, array $closure, $full = false){
        extract($closure);
        $class = ucfirst($class);
        //Objeto criado para pegar a informacao
        $class = "\Talaka\Controllers\Users\\".$class;
        $obj = new $class($class);
        //Method precisa de GET
        $method = $met.$httpMethod;
        //Executa e pega infos
        $info = (isset($arg0))? ( (isset($arg1))? json_decode($obj->$method($arg0,$arg1) )  : json_decode($obj->$method($arg0)) ) : json_decode($obj->$method());
        return ($full)? $info : (null === @json_decode($info->data))?/* Nao JSON */$info :(array)json_decode($info->data);
    }
    
    public function load($url, $data=[""]){
        extract($data);
        ob_start();
        include(BASE.$url);
        $renderedView = ob_get_clean();
        $this->view .= $renderedView;
    }
    
    public function render($json = false){
        ($json)? header('Content-Type: application/json; charset=utf-8') : header('Content-Type: text/html; charset=utf-8');
        echo $this->view;
    }

}

?>