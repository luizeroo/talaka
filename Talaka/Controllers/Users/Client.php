<?php

namespace Talaka\Controllers\Users;

use Talaka\Models\Payment;

class Client extends User{
    
    private $pay;
    
    public function __construct($type){
        parent::__construct($type);
        file_put_contents('php://stderr', print_r("\n criado com sucesso - Client \n", TRUE));
    }
    
    public function __call($met,$arg){
        return json_encode(array('stats' => 'fail', 'data' => 'Metodo "'.$met .'" nao encontrado na classe Client'));
        http_response_code(404);
    }
    
    //Project methods
    public function projectPOST($id){
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json" || $id === null){
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            $obj->ds_project = htmlspecialchars_decode( htmlentities($obj->ds_project) );
            $obj->ds_resume = htmlspecialchars_decode( htmlentities($obj->ds_resume) );
            $obj->cd_user = $id;
            $obj->dt_begin = date("Y-m-d");
            if($this->db->insert('Project',$obj) ){
                $this->db->firstFinancing($id);
                $resp = "success";
            }else{
                $resp =  "fail_insert";;
            }
            return json_encode(array("stats" => $resp, "data" => null));
        }else{
            return json_encode(array("stats" => "fail_content_type_or_id_not_passed", "data" => null));
            http_response_code(400);
        }
    }
    
    public function investPOST($id){
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json" && $id !== null){
            $json = file_get_contents('php://input');
            $jsonObj = json_decode($json);
            $obj = new stdClass();
            $obj->cd_user = $id;
            $obj->cd_project = $jsonObj->project;
            $obj->vl_financing = $jsonObj->vl;
            $obj->nm_paymethod = $jsonObj->method;
            $obj->dt_financing = date("Y-m-d");
            //Anônimo
            $obj->ic_anonymous = ($jsonObj->mode == "anonimo") ? 1 : 0 ;
            
            $resp = ( $data = $this->db->insert('Financing',$obj) )? "success" : "fail_insert";
            //Caso tenha inserido com sucesso
            if($resp === "success"){
                //Pega informacoes do usuario
                $user = json_decode( $this->db->consultUser($id) );
                
                //id do financiamento
                $data = json_decode($data);
                
                //Monta informacoes da transacao
                $infoT = $obj;
                $infoT->vl_financing = ($jsonObj->vl * 100); 
                $infoT->nm_user = $user->nome;
                $infoT->ds_email = $user->email;
                $infoT->id_financing = $data->id_financing;
                if($jsonObj->method == "credit_card"){
                    $infoT->card = $jsonObj->card;
                }
                
                //Cria payment
                $this->pay = new Payment();
                $this->pay->doTransaction($infoT);
            }
            $vetor = array("stats" => $resp, "data" => $infoT);
            return json_encode( $vetor );
        }else{
            return json_encode(array("stats" => "fail_content_type_or_id_not_passed", "data" => null));
        }
    }
    
    public function postbackPOST($id_user, $id_financing){
        //Pega parametros
        $payload = file_get_contents("php://input");
        $headers = getallheaders();
        $this->pay = new Payment();
        //autentica
        if( $this->pay->doPostBack($payload, $headers) ){
            $obj = new stdClass();
            $obj->ic_paid = 1;
            $obj->dt_payment = date("Y-m-d H:i:s");
            $where = array("cd_user" => (int)$id_user, "cd_financing" => (int)$id_financing);
            $resp = ( $this->db->alter('Financing',$obj,$where) )? "success" : "fail_update_financing";
            $vetor = array("stats" => $resp, "data" => null);
            return json_encode( $vetor );
            
        }
        
    }
    
    public function profilePUT($id){
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json" || $id === null){
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            if(isset($obj->ds_pwd)){
                $obj->ds_pwd = hash("ripemd160" , $obj->ds_pwd);
            }
            $where = array("cd_user" => (int)$id); 
            $resp = ( $this->db->alter('User',$obj,$where) )? "success" : "fail_update_profile";
            $vetor = array("stats" => $resp, "data" => null);
            return json_encode( $vetor );
        }else{
            return json_encode(array("stats" => "fail_content_type_or_id_not_passed", "data" => null));
            http_response_code(400);
        }
    }
   
	public function authPOST(){
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json"){
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            $resp = $this->db->checkUser($obj);
            return $resp;
        }else{
            http_response_code(400);
            return json_encode(array("stats" => "fail_content_type", "data" => null));
        }
         
    }
    
    public function altprojectPUT($id){
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json" || $id === null){
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            $where["cd_project"] = $id;
            $resp = ($this->db->alter("Project",$obj,$where))? "success" : "fail_alter_project";
            return json_encode(array("stats" => $resp, "data" => null));
        }else{
            return json_decode(array("stats" => "fail_alter_project", "data" => null));
            http_response_code(400);
        }
    }
    
    public function statisticGET($id){
        $resp = ($data = $this->db->dataProject(new Project(array("id"=>$id))))?"success" : "fail_get_statistic";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function commentsPOST($id){
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json" || $id === null){
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            $obj->cd_user = $id;
            $obj->ds_comment = htmlspecialchars_decode( htmlentities($obj->ds_comment) );
            $obj->dthr_comment = date("Y-m-d h:i:s");
            if($this->db->insert('Comment',$obj) ){
                $resp = "success";
            }else{
                $resp =  "fail_insert";
            }
            return json_encode(array("stats" => $resp, "data" => null));
        }else{
            return json_encode(array("stats" => "fail_content_type_or_id_not_passed", "data" => null));
        }
    }
}

?>