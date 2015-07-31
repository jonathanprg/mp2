<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "lib/mercadopago.php";
$mp = new MP("3307899484753782", "t1Al07IffdMqHSL90gqc4WBXuBEwCjNh");
        // 1 - Envia o token 
        $preference = array(
	    "card_token"=> $_REQUEST['card_token_id'],
	    "payer_email"=> "test_user_732138@testuser.com", 
	    "back_url"=> "http://54.232.96.103/preapproval/charge.php",//UMA VALIDA MAS A PRINCIPIO NAO SERA USADA
            "external_reference"=> "OP-1234", 
	    "reason"=>"Detailed description about your service",
            "auto_recurring" => array(
                "frequency" => 1,
                "frequency_type" => "months",
                "transaction_amount" => 5.87,
                "currency_id" => "BRL",
                "start_date" => "2015-08-01T14:58:11.778-04:00",
                "end_date" => "2015-08-23T14:58:11.778-04:00"
            )
                        
        );
   
        $preferenceResult = $mp->create_preapproval_payment($preference);
        echo "<pre>";
        print_r($preferenceResult);
        echo "</pre>";
        //echo '<br><h1><a href="charge.php?preapproval_id=' . $preferenceResult["response"]["id"] .'"  >Charge!</a></h1>';
        
               
        
?>
    
