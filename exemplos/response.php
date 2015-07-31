<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once "lib/mercadopago.php";
// 5031 4332 1540 6351
$mp = new MP("3821444876288488", "1MsZwpHqFP2MDPh1d4IaXsIrUAbIXbjt");

print_r($_REQUEST);
/*
$hoje = date("Y_m_d");
$arquivo = fopen("log_tarefa.$hoje.txt", "ab");
$hora = date("H:i:s T");
fwrite($arquivo,  $_REQUEST['card_token_id']." [$hora] Tarefa executada.\r\n");
fclose($arquivo);
*/


$valor = rand(10,350);

$preference = array(
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
        "email"=> "test_user_732138@testuser.com",
        "first_name"=> "name",
        "last_name"=> "lastName",
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

$preferenceResult = $mp->invisible($preference);




?>

