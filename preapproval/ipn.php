<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/mercadopago.php";
$mp = new MP("6779072058140486", "1EIP7wKRmfwCPX86U1uWE1IU4MYqk2OX");

/*
switch ($_GET["topic"]) {
    
    case "payment":
        
        $mp->sandbox_mode(true);
        $payment_info = $mp->get_payment_info($_GET["id"]);
        
        if ($payment_info["status"] == 200) {
            print_r($payment_info);
        }      
    break;
            
    case "preapproval" :        

        $payment_info = $mp->get_preapproval_payment($_GET["id"]);
        
        if ($payment_info["status"] == 200) {
            print_r($payment_info);
        }   
    break;    
    
    case "authorized_payment":
        
        $payment_info = $mp->get_authorized_payment($_GET["id"]);
        
        if ($payment_info["status"] == 200) {
            print_r($payment_info);
        }   
    break;
    
}
*/

        



 if ($_GET["topic"]=="payment"){
    
    $mp->sandbox_mode(true);
    $payment_info = $mp->get_payment_info($_GET["id"]);
        // Show payment information
    if ($payment_info["status"] == 200) {
        
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n<tr><td>". $payment_info["response"]["collection"]["id"] . "</td>");
        fwrite($arquivo,"\n<td>". $payment_info["response"]["collection"]["status"] . "</td>");
        fwrite($arquivo,"\n<td>". $payment_info["response"]["collection"]["status_detail"] . "</td>");
        fwrite($arquivo,"\n<td>". $payment_info["response"]["collection"]["transaction_amount"] . "</td>");
        fwrite($arquivo,"\n</tr>");
        
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n<tr><td colspan='4'>  RESPONSE COLLECTION : ". json_encode($payment_info) . "</td>");
        fwrite($arquivo,"\n</tr>");
        fclose($arquivo);
        fclose($arquivo);
        
    }
} else {
        /*
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,'<br> Teste: ' . $_GET["id"] . $_GET["topic"]  );
        fclose($arquivo);
        */
        
        if ($_GET["topic"]=="preapproval"){
            
        $mp->sandbox_mode(false);
        
        $payment_info = $mp->get_preapproval_payment($_GET["id"]);
                 
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n<tr><td colspan='4'>  RESPONSE PREAPPROVAL : ". json_encode($payment_info) . " </td>");
        fwrite($arquivo,"\n</tr>");
        fclose($arquivo);
        
        }
        
         if ($_GET["topic"]=="authorized_payment"){
            
        $mp->sandbox_mode(false);
        
        $payment_info = $mp->get_authorized_payment($_GET["id"]);
                 
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n<tr><td colspan='4'>  RESPONSE AUTHORIZED PAYMENT : ". json_encode($payment_info) . "  </td>");
        fwrite($arquivo,"\n</tr>");
        fclose($arquivo);
        
        }
        

}


?>