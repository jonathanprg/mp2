<!DOCTYPE html>
<html>
<head>
    <title>
       Preapproval and Authorized Payment
    </title>
    <link rel="stylesheet" href="https://a248.e.akamai.net/secure.mlstatic.com/org-img/ch/ui/1.0.0/chico.min.css">
</head>
      
<body style="margin: 0 auto;width: 1164px;">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/mercadopago.php";
$mp = new MP("6779072058140486", "1EIP7wKRmfwCPX86U1uWE1IU4MYqk2OX");

$cardata= array(
		"card_number" => "", //
		"security_code" => "",
		"expiration_month" => 10,
		"expiration_year" => 2017,
		"cardholder" => array( 
			  "name" => "CARLOS E R CORREA",
			  "identification" => array (
			      "type" => "",
			      "subtype" => null,
			      "number" => ""
			  )
		      )
	       );

		
$Result = $mp->get_cardtoken($cardata);

echo "<pre> <H1> 1 - Tokenization credit card </H1>";
print_r($Result);
echo "</pre>";
   
        // 1 - Envia o token 
        $preference = array(
	    "card_token"=> $Result["response"]["id"],
	    "payer_email"=> "cadu.rcorrea@gmail.com", 
	    "back_url"=> "http://54.232.96.103/preapproval/charge.php",//UMA VALIDA MAS A PRINCIPIO NAO SERA USADA
            "external_reference"=> "123456", 
	    "reason"=>"Teste BR - Prefix Ecommerce 28042014"
        );
        
        $preferenceResult = $mp->create_preapproval_payment($preference);
        echo "<pre> <H1> 2 - Create preapproval and store [id] in your datamodel </H1>";
        print_r($preferenceResult);
        echo "</pre>";
        echo '<br><H1> 3 -  Charge Buyer  </H1><h1><a href="charge.php?preapproval_id=' . $preferenceResult["response"]["id"] .'"  >Charge!</a></h1>';
        
               
        
?>
    

</body>
</html>