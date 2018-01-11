<?php

namespace Talaka\Controllers\Users;

use Talaka\Models\System;
use Talaka\Models\Project;

class Admin extends Client{
    
    public function __construct($type){
        parent::__construct($type);
        file_put_contents('php://stderr', print_r("\n criado com sucesso - Admin \n", TRUE));
    }
    
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
    
    public function approvedPOST($request){
        $accept = $request->getHeader("content-type");
        if($accept === "application/json"){
            if($request->getHeader('talaka-admin-authorization') === "ehiwk51"){
                $id = $request->getAttribute("id");
                $approved = (object)["ic_approved" => 1];
                $resp = ($this->db->alter("Project",$approved,["cd_project" => $id]))? "success" : "fail_approve";
                return json_encode([
                    "stats" => $resp,
                    "data"  => null
                ]);
            }else{
                http_response_code(400);
                return json_encode(array("stats" => "not_allowed", "data" => null));
            }
        }else{
            http_response_code(400);
            return json_encode(array("stats" => "fail_content_type", "data" => null));
        }
    }
    
    public function delPOST($request){
        $accept = $request->getHeader("content-type");
        if($accept === "application/json"){
            if($request->getHeader('talaka-admin-authorization') === "ehiwk51"){
                $id = $request->getAttribute("id");
                $resp = ($this->db->delProject($id))? "success" : "fail_approve";
                return json_encode([
                    "stats" => $resp,
                    "data"  => null
                ]);
            }else{
                http_response_code(400);
                return json_encode(array("stats" => "not_allowed", "data" => null));
            }
        }else{
            http_response_code(400);
            return json_encode(array("stats" => "fail_content_type", "data" => null));
        }
    }
    
    //Funcoes diretas
    public function adminInfo($table, $where, $columns){
        return $this->db->selectRaw($table, $where, $columns);
    }
    
    
}