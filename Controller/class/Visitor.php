<?php

header("Content-Type: application/json");

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
    
    
    public function userPOST(){
        $file = $_FILES["img"];
        //Upload de img
        $img = $this->upload($file,"user-img/");
        if($img["status"] == "OK"){
            $nome = $_POST['nome'];
            $date = $_POST['nascimento'];
            $login= $_POST['login'];
            $pwd  = $_POST['password'];
            $bio  = $_POST['bio'];
            $obj  = (object)array(  "nm_user" => $nome,
                                    "ds_pwd" => $pwd,
                                    "dt_birth" => $date,
                                    "ds_biography" => $bio,
                                    "ds_login" => $login,
                                    "ds_path_img" => $img["name"]);
            $obj->ds_img_back = "grimgar.png";
            // $obj->ds_biography = htmlspecialchars_decode( htmlentities($obj->ds_resume) );
            $obj->ds_pwd = hash("ripemd160" , $obj->ds_pwd);
            if($this->db->insert('User',$obj)){
                $login = (object)array("login" => $obj->ds_login, "pwd" => $pwd);
                $resp = "success";
                $this->db->checkUser($login);
            }else{
                $resp = "fail cad";
            }
            return json_encode(array("stats" => $resp, "data" => null));
        }else{
            return json_encode(array("stats" => "fail img", "data" => null));
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
    
    
}


?>