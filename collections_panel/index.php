<?php
ob_start();  
session_start();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 ie6" lang="pt-br"> <![endif]-->
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="pt-br"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="pt-br"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="pt-br"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt-br"> <!--<![endif]-->
<html>
<head>
<title>Autenticação</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/navbar-fixed-top.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/chico-min-0.12.2.css">
   
<style type="text/css">
body {
	margin:0;
	padding:0;
	text-align:center;
       	}
#tudo {
	width: 960px;
	margin:0 auto;			
	text-align:left; /* "remédio" para o hack do IE */	
	}
#conteudo {
	padding: 5px;
        padding-top: 60px;
       
	}
</style>
</head>
<body>
<div id="tudo">
    
    <div id="conteudo">
        <div class="ch-box">
	    <h2>Autenticação</h2>
	    
	    <fieldset>
                <form action="#" method="post">
		<p class="ch-form-row ch-form-required"><label for="url">Client ID:</label>
		    <input id="clientid" name="clientid" size="40" required="required" placeholder="Client ID">
		</p>
		<p class="ch-form-row ch-form-required"><label for="url">Client Secret:</label>
		<input id="clientsecret" name="clientsecret" size="40" required="required" placeholder="Client Secret">
		</p>
                <div class="ch-box-information">Para obter seu Client ID e Secret <a href="https://www.mercadopago.com/mlb/ferramentas/aplicacoes" target="new" > clique aqui </a> </div>
               <p class="ch-form-actions">
				<input type="submit" name="Auth" value="Autenticar" class="ch-btn">
				<input type="reset" value="Reset" class="ch-btn ch-btn-small">		
                </p>
               </form>
                
<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
//echo phpinfo();

include 'lib/mercadopago.php';        
        
  if (isset($_REQUEST['clientid'])){
    
  $user = $_REQUEST['clientid'];
  $pass = $_REQUEST['clientsecret'];
  
  $mp= new MP($user,$pass);
  
  $response = $mp->get_auth();
  
  if($response=='200' ){
    $_SESSION['user'] = $user;
    $_SESSION['pass'] = $pass;
    header("Location: search.php" );
    
    }else {
    echo ("<br><br><div class='ch-box-error'><h3>Login Incorreto</h3><p></p></div>");
    }
  }
?>
     
    </fieldset>
</div>
    </div>
</div>
    
    <script src="js/jquery.js"></script>
    <script src="js/chico-min-0.12.2.js"></script>    
    </body>
    
</htmL>
                
