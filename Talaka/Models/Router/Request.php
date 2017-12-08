<?php

namespace Talaka\Models\Router;

class Request{

    private $params = [];
    private $attrs = [];
    private $httpMethod = "";
    private $headers = [];
    private $body = [];
    private $files = [];
    
    public function __construct($httpMethod,$headers,$rawBody,$files){
        $this->httpMethod = $httpMethod;
        $this->headers = $headers;
        $this->body = $rawBody;
        $this->files = $files;
    }
    
    public function setParam($key, $value){
        $this->params[$key] = $value;
    }
    
    public function setAttribute(array $attrs){
        foreach($attrs as $key => $value){
            $this->attrs[$key] = $value;   
        }
    }
    
    public function getFile($file){
        return $this->files[$file];
    }
    
    public function getFiles(){
        return $this->files;
    }
    
    public function getBody(){
        return $this->body;
    }
    
    public function getHeader($name){
        return $this->headers[$name];
    }
    
    public function getHeaders(){
        return $this->headers;
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
    
    public function getAttributes(){
        return $this->attrs;
    }
    
    public function getHttpMethod(){
        return $this->httpMethod;
    }
    
}