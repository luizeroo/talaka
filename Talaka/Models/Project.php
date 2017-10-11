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
    private $creator;
    private $visit;
    private $total;
    private $close;

    
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
    
    public function toJSON(){
        return json_encode($this->toArray());
    }
    
}
/*



$project = new Project(array(  "id" => "1",
                            "title" => "Akira",
                            "ds" => "Teste"
                            ));
var_dump($project->toJSON());
*/

?>