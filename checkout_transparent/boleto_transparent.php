<?php
require_once "lib/mercadopago.php";
$mp = new MP("client_id", "client_secret");

$valor = rand(10,350);

   
$prefboleto = array(
    "amount"=> $valor,
    "payment_method_id"=> "bolbradesco",
    "currency_id" => "BRL",
    "external_reference" => "my_order_1234",
     "items"=> array(array(
        
            	"id"=> "2133",
            	"title"=> "Titulo do produto",
            	"description"=> "Descricao ",
            	"picture_url"=> "http=>//2.bp.blogspot.com/-Zu-IpE01s5Y/TtEAy89fUzI/AAAAAAAAAXE/0_ZrT5SUbUQ/s1600/unicef.jpg",
            	"category_id"=> "others",
                "quantity"=>1,
                "unit_price"=> $valor
      )
    ),
    "customer"=> array(
        "email"=> "test_user_63543738@testuser.com",
        "first_name"=> "TESTE",
        "last_name"=> "nome",
        "phone"=> array(
            "area_code"=> "011",
            "number"=> "38882377"
        ),
        "identification"=> array(
            "type"=> "CPF",
            "number"=> "19119119100"
        ),
        "address"=> array(
            "zip_code"=> "06541005",
            "street_name"=> "Street name",
            "street_number"=> 1
        ),
        "registration_date"=> "2014-06-28T16:53:03.176-04:00"
    ),
    "shipments"=> array(
        "receiver_address"=> array(
            "zip_code"=> "06541005",
            "street_name"=> "Street name",
            "street_number"=> 1,
            "floor"=> "5",
            "apartment"=> "c"
        )
    )
);

$boleto = $mp->boleto_preference($prefboleto);


?>

<html>
    <head>
        <title>MercadoPago SDK - Boleto Transparente</title>
    </head>
    <body><br>
		<a href="<?php echo $boleto['response']['activation_uri']; ?>" name="MP-Checkout" class="green-L-Rn" mp-mode="redirect" >Boleto</a>
		

		<script type="text/javascript">
				
		(function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
		s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";
		var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}
		window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
		</script>
    </body>
</html>
