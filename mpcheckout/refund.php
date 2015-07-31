<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
include "header.php";

    
  ?>
  


<div class="navbar-default navbar-fixed-top" role="navigation">
    <div class="container" style="width: auto;">    
        <div class="collapse navbar-collapse" >
            <ul class="nav navbar-nav">
               <li> <img src="https://a248.e.akamai.net/secure.mlstatic.com/components/resources/mp/css/assets/desktop-logo-mercadopago.png" style='width: 110px;padding-top: 10px;padding-right: 14px;'> </li>
                <li><a href="menu.php">Gerar Pagamentos</a></li>
                <li class="active"><a href="search.php">Buscar Pagamentos</a></li>
            </ul>
	    <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="destroy.php">Logoff</a></li>
          </ul>
        </div> 
    </div>
</div>	
		
        <div class="ch-box">
<?php

if (isset($_POST["refund"])) {

        require_once "lib/mercadopago.php";
        $clientid = $_SESSION['user'];
        $clientsecret = $_SESSION['pass'];
        
        $mp = new MP($clientid ,$clientsecret);
    
    
    if ($_REQUEST['refund']=="Cancel"){
        
        $searchResult = $mp->cancel_payment($_REQUEST['idmp']);
        
	if ($searchResult["status"]==200){
        
	echo "<div class='ch-box-ok' ><h2> Operação: " . $_REQUEST['idmp'] ." cancelada com sucesso!</h2></div>";
	
	}
	else{
	
	echo "<div class='ch-box-error'><h2> Erro! Operação: " . $_REQUEST['idmp'] ." não foi cancelada!</h2><div>";    
	    
	}
        
    }else{
        
       $searchResult = $mp->refund_payment($_REQUEST['idmp']);
       
       if ($searchResult["status"]==200){
        
	echo "<div class='ch-box-ok' ><h2> Operação: " . $_REQUEST['idmp'] ." devolvida com sucesso!</h2></div>";
	
	}
	else{
	
	echo "<div class='ch-box-error'><h2> Erro! Operação: " . $_REQUEST['idmp'] ." não foi devolvida!</h2><div>";    
	    
	}      
               
    }
    
}


?>
<div>
<?php include "footer.php"; ?>