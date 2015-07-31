<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/mercadopago.php";
$mp = new MP("3821444876288488", "1MsZwpHqFP2MDPh1d4IaXsIrUAbIXbjt");


        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n POST <? echo('<pre>'); ?> ". $_SERVER ['REQUEST_URI']. "<? echo('</pre>'); ?><br><br>");
        fclose($arquivo);

switch ($_GET["topic"]) {
    
    case "payment":

        $payment_info = $mp->get_payment_info($_GET["id"]);
        
        if ($payment_info["status"] == 200) {
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n<? echo('<pre>'); ?> ". json_encode($payment_info) . "<? echo('</pre>'); ?><br><hr><br>");
        fclose($arquivo);
        }      
    break;
            
    case "preapproval" :        

        $payment_info = $mp->get_preapproval_payment($_GET["id"]);
        
        if ($payment_info["status"] == 200) {
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n<pre> ". json_encode($payment_info) . "</pre><br><hr><br>");
        fclose($arquivo);
        }   
    break;    
    
    case "authorized_payment":
        
        $payment_info = $mp->get_authorized_payment($_GET["id"]);
        
        if ($payment_info["status"] == 200) {
        $arquivo = fopen('result_ipn.php','a');
        fwrite($arquivo,"\n<pre> ". json_encode($payment_info) . "</pre><br><hr><br>");
        fclose($arquivo);
        }   
    break;
    
}

      
      
   