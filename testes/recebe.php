<?php

    require("../Model/Pagarme/Pagarme.php");

    session_start();
    
    Pagarme::setApiKey("ak_test_akEfrSDuYXgLCkVJOu0ZNG5ETWwXe0");
    
    //$RequestBody = file_get_contents("php://input"); 
    $RequestBody = $_POST;
    $headers = getallheaders();
    $file = fopen("test.txt","w");
    
    $h = "(";
    /*
    foreach( $headers as $value){
        $h.= "[".key($headers)."] =>". $value;
    }
    */
    while ($value = current($headers)) {
        $h.= " [".key($headers)."] => ". $value;
        next($headers);
    }
    $h .= " )";
    //echo $h;
    $r = "(";
    while ($val = current($RequestBody)) {
        if(is_array($val)){
            $v = "(";
            while ($a = current($val)) {
                $v.= " [".key($val)."] => ". $a;
                next($val);
            }
            $v .= " )"; 
        }else{
            $v = $val;
        }
        
        $r.= " [".key($RequestBody)."] => ". $v;
        next($RequestBody);
    }
    $r .= " )"; 
    
    $payload = file_get_contents("php://input");
    
    fwrite($file, "Headers \n ".$h." \n Body \n".$r . "\n Raw \n". $payload);
  
    fclose($file);
    if(PagarMe::validateRequestSignature($payload, $headers['x-hub-signature'] )){ 
        echo "Postback válido!" ;
      
    }else{
        echo "Postback inválido";
    }
    

?>