<?php

abstract class User{
    
    protected $db;
    
    public function __construct($type){
        $this->db = new System($type);
    }
    
    public function __call($met,$arg){
        return json_encode(array('stats' => 'fail', 'data' => 'metodo "'.$met .'" nao encontrado na classe Visitor'));
        http_response_code(404);
    }
    
    public function allprojectGET(){
        $resp = ( $data = $this->db->listarProject() )? "success" : "fail_list";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function projectGET($id){
        $resp = ( $data = $this->db->consultarProject($id) )?"success" : "fail_select";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function commentsGET($id){
        $resp = ( $data = $this->db->getComments($id) )?"success" : "fail_select";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function pesqNameGET($name,$pag){
        $resp = ( $data = $this->db->pesqProject($name,$pag) )? "success" : "fail_select";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    //-------------PROJETOS DA PAG INICIAL-------------------//
    public function pesqGET($type,$num){
        $resp = ($data = $this->db->listProject($num,$type) )? "success" : "fail_select";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function catGET($cat,$pag){
        $resp = ( $data = $this->db->pesqCat($cat,$pag) )? "success" : "fail_list";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function profileGET($id){
        $resp = ($data = $this->db->consultarUser($id))? "success" : "fail_alter_project";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function myprojectsGET($id){
        $resp = ($data = $this->db->listMyProjects($id))? "success" : "fail_alter_project";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    public function myfinancesGET($id){
        $resp = ($data = $this->db->listMyFinances($id))? "success" : "fail_alter_project";
        return json_encode(array("stats" => $resp, "data" => $data));
    }
    
    //Especiais
    public function visitationPUT($id){
        $num = (int)json_decode($this->db->consultarProject($id))->visit;
        $obj = (object)array("qt_visitation" => ($num + 1));
        $where = array("cd_project"=>$id);
        $r = ($this->db->alterar("Project",$obj,$where))? "success" : "fail";
        return json_encode(array("stats"=>"success","data"=>$r));
    }
    
    protected function upload($file, $target_dir){
        $name = date("Y-m-d").basename($file["name"]);
        $target_file = $target_dir . $name;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $status = "File is not an image.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $status = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $status .= " Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], dirname(__FILE__)."/../../".$target_file)) {
                $status = "OK";
                
            } else {
                $status = "Sorry, there was an error uploading your file.";
            }
        }
        $nm = ($status == "OK")? $name : null;
        return array("status"=> $status, "name" => $nm);
    }
}


?>