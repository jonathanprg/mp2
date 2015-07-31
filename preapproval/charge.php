<!DOCTYPE html>
<html>
<head>
    <title>
        Charge Buyer
    </title>
    <link rel="stylesheet" href="https://a248.e.akamai.net/secure.mlstatic.com/org-img/ch/ui/1.0.0/chico.min.css">
</head>
      
<body style="margin: 0 auto;width: 1164px;">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/mercadopago.php";
$mp = new MP("6779072058140486", "1EIP7wKRmfwCPX86U1uWE1IU4MYqk2OX");

      //echo $_REQUEST['preapproval_id'].'<br>';
    
      $preference = array(
        "preapproval_id"=>$_REQUEST['preapproval_id'], 
        "transaction_amount"=> 17.12, 
         "currency_id"=> "BRL", 
         "external_reference"=> "555"
        );
    
        $preid=$_REQUEST['preapproval_id'];  
        $preferenceResult = $mp->create_charge_payment($preference);
        echo "<br>Response:";
        echo "<pre>";
        print_r($preferenceResult);
        echo "</pre>";
        echo '<br><a href="charge.php?preapproval_id=' . $preferenceResult["response"]["preapproval_id"] . '" >Charge!</a>';
  

?>


</body>
</html>