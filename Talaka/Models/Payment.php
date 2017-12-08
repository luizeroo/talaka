<?php

namespace Talaka\Models;


class Payment{
    
    //APIKEY Pagar.me
    private $apikey = "ak_test_akEfrSDuYXgLCkVJOu0ZNG5ETWwXe0";
    private $transac_info;
    private $transaction;
    private $pagarMe;
    
    
    public function __construct(){
        
        file_put_contents('php://stderr', print_r("\n criado com sucesso - Payment \n", TRUE));
    }
    
    public function __call($met,$arg){
        return json_encode(array('stats' => 'fail', 'data' => 'metodo "'.$met .'" nao encontrado na classe Client'));
        http_response_code(404);
    }
    
    public function doTransaction($infos){
        //Cria objeto de Pagarme
    	$this->pagarMe = new \PagarMe\Sdk\PagarMe($this->apikey);
        //Dados de Transaction
    	$this->transac_info["amount"] = $infos->vl_financing;
    	$this->transac_info["installments"] = 1;
    	$this->transac_info["capture"] = true;
    	$this->transac_info["postbackUrl"] = "https://talaka-beta-gmastersupreme.c9users.io/pagarme/exec/postback/".$infos->cd_user."/".$infos->id_financing;
    	$this->transac_info["metadata"] = [
            "id_project" => $infos->cd_project
        ];
    
    	//User
    	$this->transac_info["customer"] = new \PagarMe\Sdk\Customer\Customer([
            "name" => $infos->nm_user,
            "document_number" => "18152564000105",
            "email" => $infos->ds_email,
            "address" => [
                "street" => "Rua Teste", 
                "neighborhood" => "Jardim Paulistano", 
                "street_number" => "1811",
                "neighborhood" => "Jardim Paulistano",
                "zipcode" => "01451001",
	            "state"         => "SP",
	            "country"       => "Brasil"
            ],
            "phone" =>  [
                "ddi" => "55",
                "ddd" => "13",
                "number" => "99999999" 
            ]
        ]);
        
        //Cartao de Credito
        if($infos->nm_paymethod == "credit_card"){
        	$this->transac_info["card"] = $this->pagarMe->card()->createFromHash(
        	    $infos->card_hash
        	);
        }else{
            //Boleto
            $this->transac_info["extras"] = [
                "soft_descriptor" => "Financiamento",
                "boleto_instructions" => "Teste de instrucoes do boleto"
            ];
        }
        //Todos os casos
        $this->transac_info["extras"]["payment_method"] = $infos->nm_paymethod;
            
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
        //Cria objeto de Pagarme
    	$this->pagarMe = new \PagarMe\Sdk\PagarMe($this->apikey);
        return ($postback = $this->pagarMe->postback()->validateRequest($payload, $headers));
    }
    
    private function createTransaction(){
        if($this->transac_info["extras"]["payment_method"] == "credit_card"){
            $transaction = $this->pagarMe->transaction()->creditCardTransaction(
        	    $this->transac_info["amount"],
        	    $this->transac_info["card"],
        	    $this->transac_info["customer"],
        	    $this->transac_info["installments"],
        	    $this->transac_info["capture"],
        	    $this->transac_info["postbackUrl"],
        	    $this->transac_info["metadata"],
        	    $this->transac_info["extras"]
        	);
        }else{
        	$transaction = $this->pagarMe->transaction()->boletoTransaction(
                $this->transac_info["amount"],
        	    $this->transac_info["customer"],
        	    $this->transac_info["postbackUrl"],
        	    $this->transac_info["metadata"],
        	    $this->transac_info["extras"]
        	);
            
        }
        return true;
    }
    
}
?>