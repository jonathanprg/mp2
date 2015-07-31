<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "lib/mercadopago.php";
$mp = new MP("5706579694766937", "KJsSfaqhcGjphxB3ZCDwPhaC4g7LmLTq");

$preapproval_data = array(
    "payer_email" => "victor".rand(0,255) . "@teste.com",
    "back_url" => "http://54.232.203.124/mercadopago/",
    "reason" => "Recorrencia MercadoPago",
    "external_reference" => "OP-1234",
    "auto_recurring" => array(
        "frequency" => 1,
        "frequency_type" => "months",
        "transaction_amount" => 60,
        "currency_id" => "BRL",
        "start_date" => "2015-08-01T14:58:11.778-04:00",
        "end_date" => "2015-08-23T14:58:11.778-04:00"
    )
);

$preapproval = $mp->create_preapproval_payment ($preapproval_data);

echo "<H2>RESPONSE</H2>";
echo "<pre>";
print_r($preapproval);
echo "</pre>";

?>

<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body><br>
		<a href="<?php echo $preapproval['response']['init_point']; ?>" name="MP-Checkout" class="green-L-Rn" mp-mode="redirect"  >Pagar</a>
		<br><br>
		
		<script type="text/javascript">
				
		(function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
		s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";
		var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}
		window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
		</script>
    </body>
</html>
