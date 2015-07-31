<?php

if (isset($_POST["_eventId_confirmation"])) {
    
    require_once "lib/mercadopago.php";
    
    $clientid = $_SESSION['user'];
    $clientsecret = $_SESSION['pass'];
    
    $mp = new MP($clientid ,$clientsecret);

$preference = array(
    'items'=> 
	array(array(
        'id'=> $_REQUEST['pedido'],
        'title'=> $_REQUEST['curso'],
        'description'=> $_REQUEST['desc'],
        'quantity'=> 1,
        'unit_price'=> (float) $_REQUEST['price'],
        'currency_id'=> 'BRL',
        'category_id'=> $_REQUEST['category']
  		)),
		    
	'external_reference'=> $_REQUEST['pedido'],
	
	'payer'=> 
                array(
        'name'=> $_REQUEST['nome'],
        'surname'=> $_REQUEST['sobrenome'],
        'email'=> $_REQUEST['email'],
        'phone' => array(
            'area_code'=> '55' . $_REQUEST['ddd'] ,
            'number' => $_REQUEST['telefone'],
        ),
        'identification' => array(
            'type'=> $_REQUEST['docto'], 
            'number' => $_REQUEST['cpf'],
        ),
        'address' => array(
            'street_name'=> $_REQUEST['endereco'],
            'street_number' =>$_REQUEST['nro'] ,
            'zip_code' =>$_REQUEST['cep'] ,
        ),
        
        
	),
        'shipments'=> 
	array(
            'receiver_address' =>array(
                'zip_code'=> $_REQUEST['cep'],
                'street_number'=> $_REQUEST['endereco'],
                'street_name'=> $_REQUEST['nro'],
                'floor'=> '',
                'apartment'=> '',                
                )
            ),
	
	'back_urls'=> 
		array(
        'success'=> '',
        'failure'=> '',
        'pending'=> ''
		),
	'payment_methods'=> 
		array(
          'excluded_payment_methods'=>array(array( 
            
			'id'=> ''
           
            )
        ),'excluded_payment_types'=>array(array( 
            
            'id'=> 'ticket'
            )
        ),'installments'=> 24
		)
);
    
    $preferenceResult = $mp->create_preference($preference);        
    echo "<br><br><div class='ch-box-ok'><h2>Envie o link abaixo para o cliente : </h2><h3>".  $preferenceResult['response']['init_point'] . "</h3></div>";}


?>

