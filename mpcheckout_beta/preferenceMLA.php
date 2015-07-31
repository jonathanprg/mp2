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
        'quantity'=> 1,
        'unit_price'=> (float) $_REQUEST['price'],
        'currency_id'=> 'ARS',
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
                'street_number'=> $_REQUEST['nro'],
                'street_name'=> $_REQUEST['endereco'],
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
            
            'id'=> ''
            )
        ),'installments'=> 24
		)
);


//print_r ($preference);


$price = (float) $_REQUEST['price'];

if ($price >= 60000 and $price <=120000 ) {
    
    
    if (($price % 60000)==0){
        
        $price1=$price-60000;
        $price2=$price-$price1;
                
                
    }else{
        
        $price1=($price * 60)/100;
        
	if ($price1>=60000){
	    
	    $price1= 60000;
	    $price2= $price - $price1;  
	    
	}else{
	    
	    $price2=($price * 40)/100;       
	    	    
	}
	
	 
        
    }
    

    $preference['items']['0']['title'] = "Pagto (01/02) " . $_REQUEST['curso'];
    $preference['items']['0']['unit_price'] = (float) $price1 ;
    
    //print_r($preference);
    
    $preferenceResult = $mp->create_preference($preference);
    
    //print_r ($preferenceResult);
    
    $preference['items']['0']['title'] = "Pagto (02/02) " . $_REQUEST['curso'];
    $preference['items']['0']['unit_price'] = (float) $price2 ;
    
    $preferenceResult2 = $mp->create_preference($preference);

    
    echo "<br><br><div class='ch-box-ok'><h2>Envie el link de abajo a su cliente, el pago fue dividido en dos links : </h2>
         <br><h3>(01/02) Valor: $price1 </h3><h3> " . $preferenceResult['response']['init_point'] . "  </h3>
         <br><h3>(02/02) Valor: $price2 </h3><h3> " . $preferenceResult2['response']['init_point'] . "  </h3></div>";
    
    
}elseif($price >=0 and $price < 60000){
    
    $preferenceResult = $mp->create_preference($preference);        
    echo "<br><br><div class='ch-box-ok'><h2>Envie el link de abajo a su cliente : </h2><h3>".  $preferenceResult['response']['init_point'] . "</h3></div>";
    
}else{
    
    echo "<br><br><div class='ch-box-error'><h2>Valor $:$price no permitido, valores aceptados: $ 0,00 a 60000,00</h2>";
    
}





    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
      



}





?>