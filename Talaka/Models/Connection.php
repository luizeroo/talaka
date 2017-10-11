<?php

namespace Talaka\Models;

class Connection{
    public static function getCon($host,$user,$pwd,$bd,$port){
        return mysqli_connect($host,$user,$pwd,$bd,$port);
    }
}

?>