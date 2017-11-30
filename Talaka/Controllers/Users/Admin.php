<?php

namespace Talaka\Controllers\Users;

use Talaka\Models\System;
use Talaka\Models\Project;

class Admin extends Client{
    
    public function authPOST(){ 
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json"){
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            $resp = $this->db->checkAdmin($obj);
            return $resp;
        }else{
            http_response_code(400);
            return json_encode(array("stats" => "fail_content_type", "data" => null));
        }
    }
    
    
}