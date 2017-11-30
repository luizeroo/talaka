<?php

namespace Talaka\Models;

include_once("../Model/Pagarme/Pagarme.php");

class Payment{
    
    //APIKEY Pagar.me
    private $apikey = "ak_test_akEfrSDuYXgLCkVJOu0ZNG5ETWwXe0";
    private $transac_info;
    private $transaction;
    
    
    public function __construct(){
        
        file_put_contents('php://stderr', print_r("\n criado com sucesso - Payment \n", TRUE));
    }
    
    public function __call($met,$arg){
        return json_encode(array('stats' => 'fail', 'data' => 'metodo "'.$met .'" nao encontrado na classe Client'));
        http_response_code(404);
    }
    
    public function doTransaction($infos){
        $this->transac_info = [
            "valid" => "secret",
            "amount" => $infos->vl_financing,
            "payment_method" => $infos->nm_paymethod,
            "postback_url" => "https://talaka-pre-alpha-gmastersupreme-1.c9users.io/exec/client/postback/".$infos->cd_user."/".$infos->id_financing,
            "customer" => [
                "name" => $infos->nm_user,
                "document_number" => "18152564000105",
                "email" => $infos->ds_email,
                "address" => [
                    "street" => "Rua Teste", 
                    "street_number" => "1811",
                    "neighborhood" => "Jardim Paulistano",
                    "zipcode" => "01451001"
                ],
                "phone" =>  [
                    "ddi" => "55",
                    "ddd" => "13",
                    "number" => "99999999" 
                ]
            ],
            "soft_descriptor" => "Financiamento",
            "boleto_instructions" => "Teste de instrucoes do boleto",
            "metadata" => [
                "id_project" => $infos->cd_project
            ]
        ];
        
        //Cartao de Credito
        if($infos->nm_paymethod == "credit_card"){
            $this->transac_info["card_number"]          = $infos->card->number;
            $this->transac_info["card_cvv"]             = $infos->card->cvv;
            $this->transac_info["card_expiration_date"] = $infos->card->expiration;
            $this->transac_info["card_holder_name"]     = $infos->card->name;
        }
        
        return ($this->createTransaction())? true : false;
    } 
    
    public function doPostBack($payload, $headers){
        if($this->validatePostBack($payload, $headers['x-hub-signature'])){
            return true;
        }else{
            return false;
        }
        
    }
    
    private function validatePostBack($payload, $headers){
        Pagarme::setApiKey("ak_test_akEfrSDuYXgLCkVJOu0ZNG5ETWwXe0");
        return (Pagarme::validateRequestSignature($payload, $headers));
    }
    
    private function createTransaction(){
        Pagarme::setApiKey("ak_test_akEfrSDuYXgLCkVJOu0ZNG5ETWwXe0");
        if($this->transac_info['valid'] === "secret"){
            unset($this->transac_info['valid']);
            $this->transaction = new PagarMe_Transaction($this->transac_info);
        
            $this->transaction->charge();
        }else{
            return false;
        }
    }
    
}
?>