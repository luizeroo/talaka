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
    public function projectPOST($request){
        $file = $request->getFile("imagemcampanha");
        $fileCapa = $request->getFile("imagemcapa");
        //Upload de img
        $img = $this->upload($file,"proj-img/");
        $imgCapa = $this->upload($fileCapa,"proj-img/");
        //$img["status"] = "OK";
        if($img["status"] == "OK"){
            $project = (object)[
                "nm_title"      => $request->getAttribute('titulocampanha'),
                "ds_project"    => htmlspecialchars_decode( htmlentities($request->getAttribute('descricaocampanha')) ),
                "ds_resume"     => htmlspecialchars_decode( htmlentities($request->getAttribute('resumocampanha') )),
                "cd_category"   => $request->getAttribute('categoriacampanha'),
                "vl_meta"       => $request->getAttribute('metaproposta'),
                "dt_final"      => $request->getAttribute('tempoestimado'),
                "cd_user"       => $_SESSION["user"]["id"],
                "dt_begin"      => date("Y-m-d"),
                "ds_path_img"   => $img["name"],
                "ds_img_back"   => $imgCapa["name"],
                "vl_collected"  => 10.00,
                "qt_visitation" => 0,
                "ds_social"     => json_encode([
                        "facebook"      => $request->getAttribute('facebook'),
                        "instagram"     => $request->getAttribute('instagram'),
                        "video"         => $request->getAttribute('video')]),
            ];
            if($idProj = $this->db->insert('Project',$project) ){
                //Coautores
                $coauthors = explode(",", $request->getAttribute('coautores'));
                
                //Loop de coautores
                foreach($coauthors as $coauthor){
                    $resultCo = $this->db->selectRaw("User","ds_login = '".$coauthor."'","cd_user");
                    //Checa retorno
                    if(count($resultCo) > 0){
                        //Insere Tag no projeto
                        $this->db->insert('Coauthor',(object)[
                                "cd_project"    => $idProj,
                                "cd_author"     => $_SESSION["user"]["id"],
                                "cd_coauthor"   => $resultCo[0]["cd_user"],
                                "nm_type"       => "editor"
                        ]);
                    }
                    //Caso nao tenha usuario com o username, o coauthor nao é inserido
                }
                
                //Tags
                $tags = explode(",", $request->getAttribute('tags'));
                //Loop de tags
                foreach($tags as $tag){
                    $tagName = htmlspecialchars_decode( htmlentities($tag));
                    $resultTag = $this->db->selectRaw("Tag","nm_tag like '%".$tagName."%'","cd_tag");
                    //Checa retorno
                    if(count($resultTag) > 0){
                        $idTag = $resultTag[0]["cd_tag"];
                    }else{
                        //Cria tags caso nao existam
                       $idTag =  $this->db->insert('Tag',(object)[
                                "nm_tag"        => $tagName,
                                "created_at"    => date("Y-m-d H:i:s")
                        ]);
                    }
                    //Insere Tag no projeto
                    $this->db->insert('ProjectTags',(object)[
                            "cd_project" => $idProj,
                            "cd_tag"     => $idTag
                    ]);
                }
                
                $resp = "success";
            }else{
                $resp =  "fail_insert";
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
            $payMethod = $jsonObj->method == "boleto" ? "boleto" : "credcard";
            $obj = (object) [];
            $obj->cd_user = $id;
            $obj->cd_project = $jsonObj->project;
            $obj->vl_financing = $jsonObj->vl;
            $obj->nm_paymethod = $payMethod;
            $obj->dt_financing = date("Y-m-d");
            //Anônimo
            $obj->ic_anonymous = ($jsonObj->mode == "anonimo") ? 1 : 0 ;
            
            $resp = ( $data = $this->db->insert('Financing',$obj) )? "success" : "fail_insert";
            //Caso tenha inserido com sucesso
            if($resp === "success"){
                //Pega informacoes do usuario
                $user = json_decode( $this->db->consultUserId($id) );
                
                //id do financiamento
                $data = json_decode($data);
                
                //Monta informacoes da transacao
                $infoT = $obj;
                $infoT->vl_financing = ($jsonObj->vl * 100); 
                $infoT->nm_user = $user->name;
                $infoT->ds_email = $user->email;
                $infoT->id_financing = $data->id_financing;
                if($jsonObj->method == "credit_card"){
                    $infoT->card_hash = $jsonObj->card_hash;
                }
                //Cria payment
                $this->pay = new Payment();
                $this->pay->doTransaction($infoT);
            }
            $vetor = ["stats" => $resp, "data" => $infoT];
            return json_encode( $vetor );
        }else{
            return json_encode(array("stats" => "fail_content_type_or_id_not_passed", "data" => null));
        }
    }
    
    public function postbackPOST($ids, $request){
        //Pega parametros
        $this->pay = new Payment();
        //autentica
        if( $this->pay->doPostBack($request["body"], $request["headers"]) ){
            $obj = (object) [];
            $obj->ic_paid = 1;
            $obj->dt_payment = date("Y-m-d H:i:s");
            $where = ["cd_user" => (int)$ids["user"], "cd_financing" => (int)$ids["financing"] ];
            $resp = ( $this->db->alter('Financing',$obj,$where) )? "success" : "fail_update_financing";
            $vetor = [
                "stats" => $resp,
                "data" => null
            ];
            return json_encode( $vetor );
            
        }
        // return json_encode([
        //     "mano"  => "Foi",
        //     "velho" => "Success",
        //     "arg0"  => $ids,
        //     "corpo" => $request["body"],
        //     "headers"  => $request["headers"]
        // ]);
        
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