<?php

namespace Talaka\Controllers;

use Talaka\Models\Page;

class ApiController{
    
    public $page;
    
    public function __construct(){
        $this->page = new Page();
        define("System-access","Allow",TRUE);
    }
    
    public function execZero($request, $response){
        $json = $this->page->curl($request->getHttpMethod(),[
            "class" => ucfirst($request->getParam('class')),
            "met"   => $request->getParam('met'),
            "arg0"  => $request->getParam('arg0')
        ], TRUE);
        $this->page->load("view/api/api.php",[
            "json" => $json
        ]);
        $this->page->render(TRUE);
    }
    
    public function exec($request, $response){
        $json = $this->page->curl($request->getHttpMethod(),[
            "class" => ucfirst($request->getParam('class')),
            "met"   => $request->getParam('met'),
            "arg0"  => $request->getParam('arg0'),
            "arg1"  => $request->getParam('arg1')
        ], TRUE);
        $this->page->load("view/api/api.php",[
            "json" => $json
        ]);
        $this->page->render(TRUE);
    }
    
    public function pure($request, $response){
        $json = $this->page->curl($request->getHttpMethod(),[
            "class" => ucfirst($request->getParam('class')),
            "met"   => $request->getParam('met'),
            "arg0"  => $request
        ], TRUE);
        $this->page->load("view/api/api.php",[
            "json" => $json
        ]);
        $this->page->render(TRUE);
        
    }
    
    public function postback($request, $response){
        $json = $this->page->curl("POST",[
            "class" => "Client",
            "met"   => "postback",
            "arg0"  => [
                "user"      => $request->getParam('user'),
                "financing" => $request->getParam('financing')
            ],
            "arg1"  => [
                "headers"   => $request->getHeaders(),
                "body"      => $request->getBody()
            ]
        ], TRUE);
        $this->page->load("view/api/api.php",[
            "json" => $json
        ]);
        $this->page->render(TRUE);
    }
    
}