<?php

namespace Talaka\Models\Router;

class Request{

    private $params = [];
    private $attrs = [];
    
    public function __construct(){
        
    }
    
    public function setParam($key, $value){
        $this->params[$key] = $value;
    }
    
    public function setAttribute(array $attrs){
        foreach($attrs as $key => $value){
            $this->attrs[$key] = $value;   
        }
    }
    
    public function getParam($name){
        return $this->params[$name];
    }
    
    public function getAttribute($name){
        return $this->attrs[$name];
    }
    
    public function getParams(){
        return $this->params;
    }
    
}