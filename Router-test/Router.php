<?php

class Router{
    
    //Routes Array
    private $routes = [
        'GET'   => [],
        'POST'  => [],
        'PUT'   => []
    ];
    
    private $request;
    
    public function __construct(){
        $this->request = new Request();
    }
    
    public function run(){
        //Get route
        //$route = $_SERVER['REQUEST_URI'];
        //Area de testes
        $route = explode("/Router-test",$_SERVER['REQUEST_URI'])[1];
        var_dump($route);
        //Get method 
        //$httpMethod = $_SERVER['REQUEST_METHOD'];
        //if($route == "/"){
        //    $closure = $this->routes[$httpMethod]['base']['closure'];
        //    var_dump($closure);
        //    return true;
        //}
        
        //Get Params And Atrributes
        //$params = explode('/', $route);
        //array_shift($params);
        //var_dump($params);
        //$closure = $this->getClosure($params,$this->routes[$httpMethod]);
    
        //var_dump($closure);
        //$func = ($this->routes[$httpMethod][$route]) ? $this->routes[$httpMethod][$route]  : false;
        //If there is no route
        /*if(!$func){
            header("HTTP/1.0 404 Not Found");
            echo "PHP continues.\n";
            die();    
        }
        */
        
        
        // return $closure($this->request, $response);
    }
    
    public function get($route, $callback){
        //Is base
        if($route == "/"){
            $this->routes['GET']['base']['closure'] = $callback;
            return true;
        }
        //Get params
        $params = explode('/', $route);
        array_shift($params);
        $params = array_reverse($params);
        $key = [];
        $auxKey= [];
        foreach($params as $i => $path){
        	$p = $this->delimiter('{','}',$path);
        	//Is a param
        	if($p){
        		$p = explode(':', $p);
        		$path = "arg";
        		$key['regex'] = $p[1];
        		$key['parameter'] = $p[0];
        	}
        	
        	if($i == 0){
        		$auxKey[$path]['closure'] = $callback;
        	}else{
        		$auxKey[$path] = $key;
        	}
        	$key = $auxKey;
        	$auxKey = [];
        }
        $this->routes['GET'] = $this->getRoute($key, $this->routes['GET']);
        return true;
    }
    
    // public function post($route, $callback){
    //     if($_SERVER['REQUEST_METHOD'] != 'POST'){
    //         header("HTTP/1.0 405 Method Not Allowed"); 
    //         include "notallowed.php";
    //         exit();
    //     }
        
    //     return $callback();
    // }
    private function getRoute(array $route, array $routes){
        //Get first key of array
        reset($route);
        $first = key($route);
        if(array_key_exists($first,$routes)){
            if(array_values($route)[0] instanceof Closure ){
                $routes[$first]['closure'] = array_values($route)[0];
            }else{
                $r = $this->getRoute(array_values($route)[0], $routes[$first] );
                $routes[$first] = $r;
            }
            return $routes;
        }else{
            //If there is no route
            $routes[$first] = reset($route);
            return $routes;
        }
    }
    
    private function getClosure(array $route, array $route){
        //Get first position
        if(array_key_exists($route[0], $routes)){
            if(isset($route[1])){
                $key = $route[0];
                array_shift($route);
                return $this->getClosure($route,$routes[$key]);
            }elseif(isset($routes['closure'])){
                return $routes['closure'];
            }else{
                return false;
            }
        }elseif(array_key_exists('arg', $routes)){
            //Is Arg
            if(preg_match("/^".$routes['arg']['regex']."$/" , $route[0] )){
                //Pass the regex
                $this->request->setParam([ $routes['arg']['parameter'] => $route[0] ]);
                if(isset($route[1])){
                    array_shift($route);
                    return $this->getClosure($route,$routes['arg']);
                }else{
                    return $routes['arg']['closure'];
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    private function delimiter($init, $end, $string){
    	if($result = explode($init ,$string)){
    		if(isset($result[1]) && $result = explode($end ,$result[1])){
    			return $result[0];
    		}
    	}
    	return false;
    }
    
}