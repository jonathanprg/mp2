<?php
ob_start();  
session_start();
   if(!isset($_SESSION['user']) && !isset($_SESSION['pass']))
   {
   
     header("Location: index.php" );
   
   }
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 ie6" lang="pt-br"> <![endif]-->
<!--[if IE 7]>	<html class="no-js  lt-ie10 lt-ie9 lt-ie8 ie7" lang="pt-br"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie10 lt-ie9 ie8" lang="pt-br"> <![endif]-->
<!--[if IE 9]>	<html class="no-js lt-ie10 ie9" lang="pt-br"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<html>
<head>	
<title>Pagamentos MercadoPago</title>
<link rel="shortcut icon" href="https://a248.e.akamai.net/secure.mlstatic.com/components/resources/mp/images/favicon.ico" />
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
        
        

        

    

        
