<?php

namespace Talaka\Controllers;

use Talaka\Models\Page;

class ApiController{
    
    public $page;
    
    public function __construct(){
        $this->page = new Page();
        define("System-access","Allow",TRUE);
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
    
}