<!DOCTYPE html>
<html>
<head>
    <title>
       Payments V1
    </title>
</head>
      
<body style="margin: 0 auto;width: 1164px;">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "lib/mercadopago.php";

$mp = new MP("APP_USR-6637655320562965-033110-3f688757fc570ebb8aa273bd614da586__LD_LB__-95095923");
$public_key = "APP_USR-596d5be0-0aae-44fe-aadf-64412d5e2941";

$cardata= array(
		
	    "card_number"=>"4766081158832200", //
	    "security_code"=> "123",
	    "expiration_month"=> 05,
	    "expiration_year"=> 2018,
	    "cardholder"=> array (
		"name"=> "JOAO ALMEIDA",
		"identification"=> array (
		    "number"=> "22488578029",
		    "type"=> "CPF"
		)
	    )

);

$Result = MPRestClient::post("/v1/card_tokens?public_key=$public_key",$cardata);


echo "<H3> 1 - Tokenization credit card </H3>";
echo "<br>Card_token: "  .$Result["response"]["id"];
echo "<br>Status: "  .$Result["response"]["status"];
echo "<br>Card_Holder: "  .$Result["response"]["cardholder"]["name"];
echo "<hr>";


echo "<pre>";
print_r ($Result);
echo "</pre>";

$payment_preference = array(
    "token"=> $Result["response"]["id"],
    "installments"=> 1,
    "transaction_amount"=> 7.49,
    "description"=> "Teste payments v1",
    "payment_method_id"=> "visa",
    "statement_descriptor" => "EBANX",
    "binary_mode" => true ,
    "payer"=> array(
        "email"=> "victor_vhv99@gmail.com"
    ),
    "additional_info"=>  array(
        "items"=> array(array(
            
                "id"=> "1234",
                "title"=> "Produto Teste",
                "description"=> "Produto Teste novo",
                "picture_url"=> "https=>//google.com.br/images?image.jpg",
                "category_id"=> "others",
                "quantity"=> 1,
                "unit_price"=> 12.30
            )
        ),
        "payer"=>  array(
            "first_name"=> "",
            "last_name"=> "",
            "registration_date"=> "",
            "phone"=>  array(
                "area_code"=> "",
                "number"=> ""
            ),
            "address"=>  array(
                "zip_code"=> "",
                "street_name"=> "",
                "street_number"=> ""
            )
        ),
        "shipments"=>  array(
            "receiver_address"=>  array(
                "zip_code"=> "",
                "street_name"=> "",
                "street_number"=> "",
                "floor"=> "0",
                "apartment"=> "0"
            )
        )
    )
  );
       

 $response_payment = $mp->post("/v1/payments", $payment_preference);

echo "<H3> 2 - Post Payment </H3>";
echo "<br>Payment_Id: "  .$response_payment["response"]["id"];
echo "<br>Status: "  .$response_payment["response"]["status"];
echo "<br>Status_detail: "  .$response_payment["response"]["status_detail"];
echo "<br>Descriptor: "  .$response_payment["response"]["statement_descriptor"];


echo "<pre>";
print_r ($response_payment);
echo "</pre>";        
?>
    

</body>
</html>