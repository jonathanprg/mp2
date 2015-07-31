<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);

require_once "lib/mercadopago.php";

$mp = new MP("2526", "CX3tqGkTmUrTQAEzY903w2alP908QSss");

$withdraw = array(
	"amount" => 10.00,
	"currency_id" => "BRL",
	"bank_account" => array( 
		"alias" => "Nico",
		"holder" => "Jorge Nicolas Roberts Eggman",
		"type" =>"checking_account",
		"number" => "91/4",
		"branch" => "6593",
		"bank_id" => "237",
		"identification" => array(
			"type" => "CPF",
			"number" => "23667673825"
		)
	)
    );

// Search payment data according to filters
$result = $mp->create_withdrawals($withdraw);

echo "<pre>";
print_r($result);
echo "</pre>";


?>