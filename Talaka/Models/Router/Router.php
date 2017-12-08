<?php

namespace Talaka\Models\Router;

use Closure;
use Talaka\Models\Router\Request;

class Router{
    
    //Routes Array
    private $routes = [
        'GET'   => [],
        'POST'  => [],
        'PUT'   => []
    ];
    
    private $request;
    
    public function __construct(){
    }
    
    public function run(){
        //Get route
        $route = $_SERVER['REQUEST_URI'];
        //Get method 
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        //Set Request
        $this->request = new Request($httpMethod,getallheaders(),file_get_contents("php://input"),$_FILES);
        if($route == "/"){
            $closure = $this->routes['GET']['base']['closure'];
            return call_user_func_array($closure,[$this->request, $response]);
        }
        
        //Get Params And Atrributes
        //Attributes
        if($httpMethod !== 'GET'){
            //Attributes are JSON
            switch($_SERVER["CONTENT_TYPE"]){
                
            case "application/json":
                if($input = json_decode(file_get_contents('php://input'), true)){
                    $this->request->setAttribute($input);
                }
                break;
            case "application/x-www-form-urlencoded":
                //Pagar.me
                break;
            case "multipart/form-data":
                $this->request->setAttribute($_POST);
                //Dados Junto
                break;
            default:
                if(explode(";",$_SERVER["CONTENT_TYPE"])[0] == "multipart/form-data"){
                    $this->request->setAttribute($_POST);
                }else{
                    //Not allowed
                    http_response_code(400);
                    header("HTTP/1.0 400 Bad Request");
                    $msg = "CONTENT TYPE Error - Expected 'Application/json or application/x-www-form-urlencoded', but '". $_SERVER["CONTENT_TYPE"]. "' send.";
                    echo json_encode(array("stats" => $msg, "data" => null));
                    die(); 
                }
                
            }
            
        }
        $params = explode('/', $route);
        array_shift($params);
        $closure = $this->getClosure($params,$this->routes[$httpMethod]);

        //If there is no route
        if(!$closure){
            http_response_code(404);
            header("HTTP/1.0 404 Not Found");
            header('location: /error/'.urlencode('Página não encontrada')); 
        }
        
        return call_user_func_array($closure,[$this->request, $response]);
    }
    
    public function get($route, $callback){
        return $this->map('GET', $route, $callback);
    }
    
    public function post($route, $callback){
        return $this->map('POST', $route, $callback);
    }
    
    public function map($method ,$route, $callback){
        //Validate callback
        if(!($callback instanceof Closure)){
            $callback = explode(":",$callback);
            $class = "\Talaka\Controllers\\".$callback[0];
            $callable = $callback[1];
            if(class_exists($class)){
                if(method_exists($class, $callable)){
                    //Define callback like a callable array
                    $callback = [new $class, $callable];
                }else{
                    //throw new \UnexpectedValueException('Callable is not string, array, or Closure');
                    header("HTTP/1.0 404 Not Found");
                    echo "Closure ERROR - Method ".$callable." not found in class ".$class;
                    die();
                }
            }else{
                header("HTTP/1.0 404 Not Found");
                echo "Closure ERROR - Class ".$class." doesn't exist";
                die();
            }   
        }
        
        //Is base
        if($route == "/"){
            $this->routes[$method]['base']['closure'] = $callback;
            return true;
        }
        
        //Get Paths
        $paths = explode('/', $route);
        array_shift($paths);
        $paths = array_reverse($paths);
        $key = [];
        //Make array path
        foreach($paths as $i => $path){
            $auxKey= [];
        	$p = $this->delimiter('{','}',$path);
        	//Is a param
        	if($p){
        		$p = explode(':', $p);
        		$path = "arg";
        		if($i == 0){
        		    $auxKey[$path]['regex'] = $p[1];
        		    $auxKey[$path]['parameter'] = $p[0];
        		}else{
        		    $key['regex'] = $p[1];
        		    $key['parameter'] = $p[0];
        		}
        	}
        	
        	if($i == 0){
        		$auxKey[$path]['closure'] = $callback;
        	}else{
        		$auxKey[$path] = $key;
        	}
        	$key = $auxKey;
        }
        //Put in router
        if(is_array($method)){
            foreach($method as $met){
                $this->routes[$met] = $this->getRoute($key, $this->routes[$met]);    
            }
        }else{
            $this->routes[$method] = $this->getRoute($key, $this->routes[$method]);
        }
        return true;
    }
    
    private function getRoute(array $route, array $routes){
        //Get first key of array
        reset($route);
        $first = key($route);
        if(array_key_exists($first,$routes)){
            if((array_values($route)[0]) instanceof Closure || is_callable(array_values($route)[0])){
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
    
    private function getClosure(array $route, array $routes){
        //Get first position
        if(array_key_exists($route[0], $routes)){
            if(isset($route[1])){
                $key = $route[0];
                array_shift($route);
                return $this->getClosure($route,$routes[$key]);
            }elseif(isset($routes[$route[0]]['closure'])){
                return $routes[$route[0]]['closure'];
            }else{
                //Nao ha funcao
                return false;
            }
        }elseif(array_key_exists('arg', $routes)){
            //Is Arg
            if(preg_match("/".$routes['arg']['regex']."/" , $route[0] )){
                //Pass the regex
                $this->request->setParam($routes['arg']['parameter'],$route[0]);
                if(isset($route[1])){
                    array_shift($route);
                    return $this->getClosure($route,$routes['arg']);
                }else{
                    return $routes['arg']['closure'];
                }
            }else{
                //Nao combina com regex
                echo "ERRO DE REGEX";
                return false;
            }
        }else{
            //Rota invalida
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