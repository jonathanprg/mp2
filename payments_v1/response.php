<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "lib/mercadopago.php";

$mp = new MP("APP_USR-6637655320562965-033110-3f688757fc570ebb8aa273bd614da586__LD_LB__-95095923");


$payment_preference = array(
    "amount"=> (float)$_REQUEST['amount'],
    "installments" => (int)$_REQUEST['installmentsOption'],
    "payment_method_id"=> $_REQUEST['paymentMethod'],
    "currency_id" => "BRL",
    "card_token_id" => $_REQUEST['card_token_id'],
    "external_reference" => "my_order_1234",
     "items"=> array(array(
        
            	"id"=> "2133",
            	"title"=> "Titulo do produto",
            	"description"=> "Descricao ",
            	"picture_url"=> "http=>//2.bp.blogspot.com/-Zu-IpE01s5Y/TtEAy89fUzI/AAAAAAAAAXE/0_ZrT5SUbUQ/s1600/unicef.jpg",
            	"category_id"=> "others",
                "quantity"=>1,
                "unit_price"=> (float)$_REQUEST['amount']
      )
    ),
    "customer"=> array(
        "email"=> "victorvthv@gmail.com",
        "first_name"=> "",
        "last_name"=> "",
        "phone"=> array(
            "area_code"=> "",
            "number"=> ""
        ),
        "identification"=> array(
            "type"=> "",
            "number"=> ""
        ),
        "address"=> array(
            "zip_code"=> "",
            "street_name"=> "",
            "street_number"=> ""
        ),
        "registration_date"=> ""
    ),
    "shipments"=> array(
        "receiver_address"=> array(
            "zip_code"=> "",
            "street_name"=> "",
            "street_number"=> "",
            "floor"=> "",
            "apartment"=> ""
        )
    )
);

$response_payment = $mp->post("/checkout/custom/create_payment", $payment_preference);

echo "<pre> <H1> 2 - Post Payment </H1>";
print_r($response_payment);
echo "</pre>";  


?>

