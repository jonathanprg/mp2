<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
require_once "lib/mercadopago.php";
$mp = new MP("3821444876288488", "1MsZwpHqFP2MDPh1d4IaXsIrUAbIXbjt");

$data = strtotime('2013-10-11 14:56:39');
//$data= $data->format('Y-m-d\TH:m:s.000P');
//echo $data->format("c").'<br>';

$data = date("Y-m-d\TH:m:s",$data);
//echo '<br>'. $data . '<br>';


$preference = array(
 
    "notification_url" => "http://54.232.96.103/exemplos/ipn.php",
    "external_reference"=> "Reference_1234",
   // "expires"=> true,
   // "expiration_date_to" =>"2014-08-22T08:02:55.663-04:00",
    "auto_return" => "all",
    "items"=> array(array(
        "id"=> "1234",
        "title"=> "titulo1234",
        "description"=> "Teste de PHP",
        "quantity"=> 1, 
        "unit_price"=> 1000,
	"category_id"=>"tickets",
        "currency_id"=> "BRL",
        "picture_url"=> "https://www.mercadopago.com/org-img/MP3/home/logomp3.gif"
  	 )),
    /*
  
    "differential_pricing" => array(
	//"id" => "1915677",
    "deductions_by_marketplace" => array(array(
            "marketplace"=> "NONE",		 
            "collector" => array(
                "financing_rate"=> 100
            ),
           
        ))
    
    ),
    */
   /*
    "differential_pricing" => array(
	"id" => "1914697",
    /*"deductions_by_installment" => array(array(
            "marketplace"=> "NONE",		 
            "collector" => array(
                "financing_rate"=> 100
            ),
           "installments"=> array(
                2,3
            ),
        ))
    
    ),*/
    
	"payer" => array(
                    "name" => "TESTE",
                    "surname" => "VASCONCELLOS",
                    "email" => "test_user_13443234@testuser.com",
                    "phone" => array(
                        "area_code" => "5511",
                        "number" => "4141-4141"),
                    "address" => array(
                        "zip_code" => "05303-090",
                        "street_name" => "consolacao",
                        "street_number" => "123"),
		    "identification"=>array(
			"type"=>"CPF",
			"number"=>"19119119100"
		    ),
								    
		    "date_created" => $data,	    
		    //"date_created" => "2013-08-13T12:00:21-03:00"
                ),
	    
	"shipments" => array( 
            "receiver_address" =>
	    array("zip_code" => "49010620",
		  "street_number" => 124,
		  "street_name"=>"Avenida Mamede Paes Mendonça",
		  "floor"=>"4",
		   "apartment"=>"C"
	    
            )),
	
	'back_urls'=> 
		array(
        'success'=> 'http://54.232.96.103/exemplos/result_ipn.php',
        'failure'=> 'http://54.232.96.103/exemplos/result_ipn.php',
        'pending'=> 'http://54.232.96.103/exemplos/result_ipn.php'
		),
	'payment_methods'=> 
		array(
          'excluded_payment_methods'=>array(array( 
            
			'id'=> ''
           
            )
        ),'excluded_payment_types'=>array(array( 
            
            'id'=> ''
            )
        ),'installments'=> 12
		)
);

/*echo "<pre>";
print_r(json_encode($preference,true));
echo "</pre>";
*/
$preferenceResult = $mp->create_preference($preference);

?>

<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>

		<br><br>
                
                <a href="<?php echo $preferenceResult["response"]["init_point"]; ?>" name="MP-Checkout" class="lightblue-L-Rn-BrOn" mp-mode="modal" >LIGHTBOX</a>
                
                <br><br>
                
                <a href="<?php echo $preferenceResult["response"]["init_point"]; ?>" name="MP-Checkout" class="lightblue-L-Rn-BrOn" mp-mode="redirect">REDIRECT</a>
                
               <br><br>
                
		<iframe src="<?php echo $preferenceResult["response"]["init_point"]; ?>" id="Checkout" name="MP-Checkout" width="740" height="600" frameborder="1"></iframe>

		<script type="text/javascript">
	    	(function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;
		s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";
		var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}
		window.$MPBR_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
		</script>
    </body>
</html>

