<?php

namespace Talaka\Controllers\Users;

class Visitor extends User{
    
    public function __construct($type){
        parent::__construct($type);
    }
    
    public function __call($met,$arg){
        return json_encode(array('stats' => 'fail', 'data' => 'metodo "'.$met .'" nao encontrado na classe Visitor'));
        http_response_code(404);
    }
    
    public function photoPOST(){
        $accept = $_SERVER["CONTENT_TYPE"];
        if($accept === "application/json"){
            $file = $_FILES['img'];
            //Checa o tipo do arquivo
            switch($file["type"]){
                case "image/jpeg":
                case "image/jpg":
                    imagejpeg($file,"../../user-img/".$file["name"]);
                    break;
                case "image/png":
                    imagepng($file,"../../user-img/".$file["name"] );
                    break;
                case "image/gif":
                    imagegif($file,"../../user-img/".$file["name"] );
                    break;
            }
            $resp = "success";
        }else{
            $resp = "fail";
        }
        return json_encode(array("stats" => $resp, "data" => null));
    }
    
    
    public function userPOST($request){
        $file = $request->getFile("fotos");
        //Upload de img
        $img = $this->upload($file,"user-img/");
        //$img["status"] = "OK";
        if($img["status"] == "OK"){
            //Dados user
            $nome = $request->getAttribute('nm_user');
            $date = $request->getAttribute('birthday_user');
            $login= $request->getAttribute('login_user');
            $email= $request->getAttribute('email_user');
            $pwd  = $request->getAttribute('password_user');
            $bio  = $request->getAttribute('bio_user');
            $cpf  = $request->getAttribute('cpf_user');
            //Endereco
            $address = json_encode([
                "street"     => $request->getAttribute('street_user'),
                "neigh"      => $request->getAttribute('neigh_user'),
                "n"          => $request->getAttribute('n_user'),
                "cep"        => $request->getAttribute('cep_user'),
                "state"      => $request->getAttribute('state_user'),
                "country"    => $request->getAttribute('country_user')
            ]);
            //Tel
            $ddd        = $request->getAttribute('ddd');
            $tel        = $request->getAttribute('tel');
            
            $obj  = (object)[
                "nm_user" => $nome,
                "ds_email" => $email,
                "ds_pwd" => $pwd,
                "dt_birth" => $date,
                "ds_biography" => $bio,
                "ds_login" => $login,
                "ds_path_img" => $img["name"],
                "cd_cpf" => $cpf,
                "ds_address" => $address,
                "cd_tel" => $ddd.",".$tel,
                "created_at" => date("Y-m-d H:i:s")
            ];
            $obj->ds_img_back = "grimgar.png";
            // $obj->ds_biography = htmlspecialchars_decode( htmlentities($obj->ds_resume) );
            $obj->ds_pwd = hash("ripemd160" , $obj->ds_pwd);
            if($this->db->insert('User',$obj)){
                $login = (object)[
                    "login" => $obj->ds_login,
                    "pwd" => $pwd
                ];
                $resp = "success";
                $this->db->checkUser($login);
            }else{
                $resp = "fail cad";
            }
            return json_encode([
                "stats" => $resp,
                "data" => null
            ]);
        }else{
            return json_encode([
                "stats" => "fail img",
                "data" => null
            ]);
        }
    }
    
    public function uploadImgPOST(){
        $file = $_FILES["img"];
        $img = $this->upload($file,"user-img/");
        if($img["status"] == "OK"){
            return json_encode(array("stats" => "GG", "data" => $img["status"]));
        }else{
            return json_encode(array("stats" => "fail img", "data" => $img["status"] . " | ".$file["name"]));
        }
    }
    
    public function testeGET(){
        $resp = ($data = $this->db->select("ProjectGallerie",[
            "cd_project" => 6
        ]))? "success" : "fail_select";
        return json_encode([
            "stats" => $resp,
            "data"  => json_encode($data) 
        ]);
    }
    
    
}


?>