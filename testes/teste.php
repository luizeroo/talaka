<?php

    require("../Model/Pagarme/Pagarme.php");

    Pagarme::setApiKey("ak_test_akEfrSDuYXgLCkVJOu0ZNG5ETWwXe0");

    $transaction = new PagarMe_Transaction(array(
        "amount" => 15000,
        "payment_method" => "boleto",
        "postback_url" => "https://talaka-pre-alpha-gmastersupreme-1.c9users.io/testes/recebe.php",
        "customer" => array(
            "name" => "Gustavo Rosario", 
            "document_number" => "18152564000105",
            "email" => "teste@gmail.com",
            "address" => array(
                "street" => "Rua Professor Luiz Carlos de Souza", 
                "street_number" => "60",
                "neighborhood" => "Jardim Umuarama",
                "zipcode" => "11740000"
            ),
            "phone" =>  array(
                "ddi" => "55",
                "ddd" => "13",
                "number" => "99999999" 
            )
        ),
        "metadata" => array(
            "idProduto" => 1
        )
    ));

    $transaction->charge();

?>