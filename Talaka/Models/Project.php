<?php

namespace Talaka\Models;

class Project{
    
    private $id;
    private $title;
    private $ds;
    private $resume;
    private $meta;
    private $collected;
    private $dtB;
    private $dtF;
    private $img;
    private $cover;
    private $creator; // name, id, img
    private $visit;
    private $total;
    private $close;
    private $idC;
    private $category; // name, id
    private $coauthor;
    private $tags;
    private $approved;

    
    public function __construct($obj){
        foreach($obj as $attr => $value ){
            $this->$attr = $value;
        }
    }
    
    public function __get($attr){
        return $this->$attr;
    }
    
    public function toArray(){
        $temp = (array)$this;
        $array = array();
        foreach ($temp as $k => $v) {
          $k = preg_match('/^\x00(?:.*?)\x00(.+)/', $k, $matches) ? $matches[1] : $k;
          $array[$k] = $v;
        }
        return $array;
    } 
    
    public static function fromDB(array $projDB){
        $project = [];
        foreach($projDB as $attr => $value){
            switch($attr){
                case "cd_project":
                    $project["id"] = $value;
                    break;
                case "nm_title":
                    $project["title"] = $value;
                    break;
                case "ds_project":
                    $project["ds"] = $value;
                    break;
                case "ds_resume":
                    $project["resume"] = $value;
                    break;
                case "vl_meta":
                    $project["meta"] = $value;
                    break;
                case "vl_collected":
                    $project["collected"] = $value;
                    break;
                case "dt_begin":
                    $project["dtB"] = $value;
                    break;
                case "dt_final":
                    $project["dtF"] = $value;
                    break;
                case "ds_path_img":
                    $project["img"] = $value;
                    break;
                case "ds_img_back":
                    $project["cover"] = $value;
                    break;
                case "cd_category":
                    $project["category"]["id"] = $value;
                    break;
                case "nm_category":
                    $project["category"]["name"] = $value;
                    break;
                case "qt_visitation":
                    $project["visit"] = $value;
                    break;
                case "ic_close":
                    $project["close"] = $value;
                    break;
                case "ic_approved":
                    $project["approved"] = $value;
                    break;
                case "cd_user":
                    $project["creator"]["id"] = $value;
                    break;
                case "nm_user":
                    $project["creator"]["name"] = $value;
                    break;
                case "imgU":
                    $project["creator"]["img"] = $value;
                    break;
                case "total":
                    $project["total"] = $value;
                    break;
            }
        }
        if( array_key_exists("creator",$project)){
            $project["creator"] = (object) $project["creator"];
        }
        return new Project($project);
    }
    
    public function toJSON(){
        return json_encode($this->toArray());
    }
    
}

?>