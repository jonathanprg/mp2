<!DOCTYPE html>
<html>
<head>
    <title>
        Sandbox Recurring
    </title>
    <link rel="stylesheet" href="https://a248.e.akamai.net/secure.mlstatic.com/org-img/ch/ui/1.0.0/chico.min.css">
</head>
      
<body style="margin: 0 auto;width: 1164px;">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/mercadopago.php";
$mp = new MP("3307899484753782", "t1Al07IffdMqHSL90gqc4WBXuBEwCjNh");

/*$preference = array(
    "payer_email" => "victor12121@gmail.com",
    "back_url" => "http://54.232.203.124/mercadopago/",
    "reason" => "Monthly subscription to premium package",
    "external_reference" => "OP-1234",
    "auto_recurring" => array(
        "frequency" => 1,
        "frequency_type" => "months",
        "transaction_amount" => 60,
        "currency_id" => "BRL",
        "start_date" => "2014-04-10T14:58:11.778-03:00",
        "end_date" => "2014-06-10T14:58:11.778-03:00"
    )
);
*/

$preference = array(
	    "payer_email"=> "test_user_732138@testuser.com",
	   // "payer_email"=> "nicolasroberts.brasil@gmail.com",
	    "back_url"=> "http://54.232.96.103/preapproval/charge.php",
            "external_reference"=> "OP-1234", 
	    "reason"=>"Detailed description about your service"
        );


 if (isset($_REQUEST['preapproval_id'])){

    echo $_REQUEST['preapproval_id'];
 
 }else{

$preferenceResult = $mp->create_preapproval_payment($preference);
echo "<pre>";
print_r($preferenceResult);
echo "</pre>";
 }
?>


      
        <a href="<?php echo $preferenceResult["response"]["init_point"]; ?>" name="MP-payButton" class="blue-L-Sq-Ge-BrAll" mp-mode="redirect"  >Subscribe!</a> 

<script type="text/javascript"> 

 (function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
 s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js"; 
 var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();} 
 window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load',$MPBR_load, false)) : null;})(); 

</script> 

<script type="text/javascript"> 

function callback_function (json) { 

 //document.write(json.parse);

 if (json.collection_status== 'authorized'){ 

 alert ('Preapproval authorized');

 } else if(json.collection_status=='dropout'){ 

 alert ('Buyer don’t finish the process'); 

 } else if(json.collection_status=='error'){ 

 alert ('Error'); 

 } 

} 

</script>
    </body>
</html>